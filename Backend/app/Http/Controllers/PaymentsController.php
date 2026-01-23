<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\TopUpPackage;
use Illuminate\Http\Request;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class PaymentsController extends Controller
{
    /**
     * List all payments
     */
    public function index()
    {
        $payments = Payments::all();
        return response()->json($payments);
    }

    /**
     * Generate checkout QR code for a TopUpPackage
     */
    public function checkout($id)
    {
        $topup = TopUpPackage::findOrFail($id);

        // Merchant info
        $merchant = new IndividualInfo(
            bakongAccountID: 'vannak_dim@cadi', // Replace with your Bakong account
            merchantName: 'VANNAK DIM',
            merchantCity: 'Phnom Penh',
            currency: KHQRData::CURRENCY_KHR,
            amount: $topup->price
        );

        $qrResponse = BakongKHQR::generateIndividual($merchant);

        return response()->json([
            'topup_package' => $topup,
            'qr' => $qrResponse->data['qr'] ?? null,
            'md5' => $qrResponse->data['md5'] ?? null,
        ]);
    }

    /**
     * Verify a transaction by MD5
     */
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

    /**
     * Save a payment record
     */
    public function storePayment(Request $request)
    {
        $request->validate([
            'topup_package_id' => 'required|exists:topup_packages,id',
            'md5' => 'required|string',
            'amount' => 'required|numeric',
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
