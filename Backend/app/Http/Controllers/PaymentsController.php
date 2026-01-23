<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\TopUpPackage;
use Illuminate\Http\Request;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class PaymentsController extends Controller
{
    // List all payments
    public function index()
    {
        $payments = Payments::all();
        return response()->json($payments);
    }

    // Checkout — generate Bakong QR
    public function checkout($id)
    {
        try {
            $topup = TopUpPackage::findOrFail($id);

            // Ensure price is integer
            $amountInKHR = (int) $topup->price;

            $merchant = new IndividualInfo(
                bakongAccountID: 'sabrey_lim@bkrt',
                merchantName: 'Sabrey Lim',
                merchantCity: 'Siem Reap',
                currency: KHQRData::CURRENCY_KHR,
                amount: $amountInKHR
            );

            $qrResponse = BakongKHQR::generateIndividual($merchant);

            return response()->json([
                'TopUpPackage' => $topup,
                'qr' => $qrResponse->data['qr'] ?? null,
                'md5' => $qrResponse->data['md5'] ?? null,
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
            'amount' => 'required|integer',
        ]);

        $payment = Payments::create([
            'topup_package_id' => $request->topup_package_id,
            'md5' => $request->md5,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Payment recorded successfully',
            'payment' => $payment
        ], 201);
    }
}
