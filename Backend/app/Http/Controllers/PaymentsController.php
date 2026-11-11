<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\TopUpPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use KHQR\Config\Constants;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Helpers\Utils;
use KHQR\Models\IndividualInfo;

class PaymentsController extends Controller
{
    private function packageCurrency(TopUpPackage $package): ?string
    {
        $currency = \App\Models\Currency::find($package->currency_id);
        $name = strtolower(trim($currency->name ?? ''));
        $symbol = trim($currency->symbol ?? '');

        return match (true) {
            $symbol === '$', in_array($name, ['usd', 'us dollar', 'us dollars'], true) => 'USD',
            in_array($symbol, ['៛', 'KHR'], true), in_array($name, ['khr', 'riel', 'cambodian riel'], true) => 'KHR',
            default => null,
        };
    }

    // List all payments
    public function index()
{
    $payments = Payments::leftJoin(
            'topup_packages',
            'payments.topup_package_id',
            '=',
            'topup_packages.id'
        )
        ->leftJoin(
            'orders',
            'payments.order_id',
            '=',
            'orders.id'
        )->leftJoin(
            'payment_type',
            'payments.payment_type_id',
            '=',
            'payment_type.id'
        )
        ->select(
            'payments.*',
            'topup_packages.name as package_name',
            'topup_packages.amount',
            'topup_packages.price',
            'orders.order_code as order_code',
            'payment_type.name as payment_type'
        )
        ->get();

    return response()->json($payments);
}


    // Checkout — generate Bakong QR
    public function checkout($id)
    {
        try {
            $topup = TopUpPackage::findOrFail($id);

            $currency = $this->packageCurrency($topup);
            $amount = (float) $topup->price;
            if (!$currency || $amount <= 0 || ($currency === 'KHR' && floor($amount) !== $amount)) {
                return response()->json(['message' => 'The package currency or price is not valid for KHQR.'], 422);
            }

            $merchant = new IndividualInfo(
                bakongAccountID: config('services.bakong.account_id'),
                merchantName: 'Sabrey Lim',
                merchantCity: 'Siem Reap',
                currency: $currency === 'USD' ? KHQRData::CURRENCY_USD : KHQRData::CURRENCY_KHR,
                amount: $amount
            );

            $qrResponse = BakongKHQR::generateIndividual($merchant);
            $qr = $qrResponse->data['qr'] ?? null;
            // The installed PHP SDK omits the expiry subtag required by newer dynamic KHQR readers.
            if (!$qr || !preg_match('/99170013(\d{13})6304[0-9A-F]{4}$/', $qr, $timestamp)) {
                throw new \RuntimeException('Unable to generate a valid dynamic KHQR timestamp.');
            }
            $expiresAt = (int) $timestamp[1] + 300000;
            $qrWithoutCrc = substr($qr, 0, -29).'99340013'.$timestamp[1].'0113'.$expiresAt.'6304';
            $qr = $qrWithoutCrc.Utils::crc16($qrWithoutCrc);

            return response()->json([
                'TopUpPackage' => $topup,
                'qr' => $qr,
                'md5' => md5($qr),
                'expires_at' => $expiresAt,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Verify a transaction by MD5
    public function verifyTransaction(Request $request)
    {
        $request->validate([
            'md5' => 'required|string',
        ]);

        try {
            $token = env('BAKONG_TOKEN'); // Your Bakong API token
            $bakong = new BakongKHQR($token);
            $result = $bakong->checkTransactionByMD5($request->md5);

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Save a payment record
    public function storePayment(Request $request)
    {
        $request->validate([
            'topup_package_id' => 'required|exists:topup_packages,id',
            'md5' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $token = config('services.bakong.token');
        if (!$token) {
            return response()->json(['message' => 'Payment verification is not configured.'], 503);
        }

        try {
            $response = Http::withToken($token)->timeout(10)->post(Constants::CHECK_TRANSACTION_MD5_URL, [
                'md5' => $request->md5,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['message' => 'Payment verification is temporarily unavailable.'], 503);
        }

        if ($response->status() === 401 || $response->status() === 403) {
            logger()->warning('Bakong rejected payment verification credentials.', ['status' => $response->status()]);
            return response()->json(['message' => 'Payment verification credentials were rejected. Please contact the administrator.'], 503);
        }

        if (!$response->successful()) {
            logger()->warning('Bakong payment verification failed.', ['status' => $response->status()]);
            return response()->json(['message' => 'Payment verification is temporarily unavailable.'], 503);
        }

        $result = $response->json();
        $transaction = $result['data'] ?? null;
        if (($result['responseCode'] ?? null) !== 0 || !is_array($transaction)) {
            return response()->json(['message' => 'Payment has not been confirmed by Bakong.'], 422);
        }

        $package = TopUpPackage::findOrFail($request->topup_package_id);
        $currency = $this->packageCurrency($package);
        $expectedAmount = (float) $package->price;
        if (!$currency || $expectedAmount <= 0 || ($currency === 'KHR' && floor($expectedAmount) !== $expectedAmount) || !isset($transaction['amount'], $transaction['hash'], $transaction['createdDateMs']) ||
            !is_numeric($transaction['amount']) || !is_numeric($transaction['createdDateMs']) ||
            !is_string($transaction['hash']) || $transaction['hash'] === '' ||
            ($transaction['toAccountId'] ?? null) !== config('services.bakong.account_id') ||
            ($transaction['currency'] ?? null) !== $currency ||
            number_format((float) $transaction['amount'], 2, '.', '') !== number_format($expectedAmount, 2, '.', '') ||
            number_format((float) $request->amount, 2, '.', '') !== number_format($expectedAmount, 2, '.', '')) {
            return response()->json(['message' => 'The verified transaction does not match this package.'], 422);
        }

        $existing = Payments::where('transaction_reference', $transaction['hash'])->first();
        if ($existing && $existing->md5 === $request->md5 &&
            (int) $existing->topup_package_id === (int) $package->id && $existing->status === 'paid') {
            return response()->json(['message' => 'Payment recorded successfully', 'payment' => $existing]);
        }
        if ($existing) {
            return response()->json(['message' => 'This transaction has already been recorded.'], 409);
        }

        $payment = Payments::create([

            'topup_package_id' => $request->topup_package_id,
            'md5' => $request->md5,
            'amount' => $expectedAmount,
            'transaction_reference' => $transaction['hash'],
            'status' => 'paid',
            'paid_at' => Carbon::createFromTimestampMs($transaction['createdDateMs'])->toDateString(),
        ]);

        return response()->json([
            'message' => 'Payment recorded successfully',
            'payment' => $payment
        ], 201);
    }
}
