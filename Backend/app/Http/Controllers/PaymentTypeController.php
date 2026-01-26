<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentType = PaymentType::all();
        return response()->json($paymentType);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=> 'required',
        ]);

         $path = $request->file('image')->store('coursels', 'public');

        // Generate public URL
        $imageUrl = asset('storage/' . $path);

        $paymentType = new PaymentType();
        $paymentType->name = $request->name;
        $paymentType->image = $imageUrl;
        $paymentType->description = $request->description;

        $paymentType->save();

        return response()->json([
            'paymentType' => $paymentType,
            'message' => 'PaymentType created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $paymentType, $id)
    {
        $paymentType = PaymentType::find($id);
        return response()->json([
            'paymentType' => $paymentType,
            'message' => 'PaymentType found successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $paymentType, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $paymentType = PaymentType::findOrFail($id);

        $paymentType->name = $request->name;
        $paymentType->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('paymentTypes', 'public');
            $paymentType->image = asset('storage/' . $path);
        }

        $paymentType->save();

        return response()->json([
            'paymentType' => $paymentType,
            'message' => 'Coursel updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType, $id)
    {
        $paymentType = PaymentType::find($id);
        $paymentType->delete();
        return response()->json([
            'paymentType' => $paymentType,
            'message' => 'PaymentType deleted successfully',
        ]);
    }
}
