<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\TopUpPackage;
use Illuminate\Http\Request;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;
use SebastianBergmann\Environment\Console;


class PaymentsController extends Controller
{

    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        // Your merchant info (replace with real Bakong account)
        $merchant = new IndividualInfo(
            bakongAccountID: 'vannak_dim@cadi',
            merchantName: 'VANNAK DIM',
            merchantCity: 'Phnom Penh',
            currency: KHQRData::CURRENCY_KHR,
            amount: $product->price
        );
        $qrResponse = BakongKHQR::generateIndividual($merchant);
            return view('products.checkout', [
            'product' => $product,
            'qr' => $qrResponse->data['qr'] ?? null,
            'md5' => $qrResponse->data['md5'] ?? null,
        ]);
    }
    public function verifyForm()
    {
        // return view('payments.verify');
    }

    public function verifyTransaction(Request $request){
    $request->validate([
        'md5' => 'required|string',
    ]);
    try {
        // Your Bakong API token from https://api-bakong.nbc.gov.kh/register
        $token = env('BAKONG_TOKEN'); // put it in .env
        $bakong = new \KHQR\BakongKHQR($token);
        $result = $bakong->checkTransactionByMD5($request->md5);
        return response()->json($result);
        // return view('payments.result', ['result' => $result]);
    } catch (\Exception $e) {
        // return back()->withErrors(['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
    public function paymentResult()
    {
        // return view('payments.result');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payments::all();
        return response()->json($payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
