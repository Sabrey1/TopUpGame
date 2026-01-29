<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class currencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = Currency::all();
        return response()->json($currency);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'symbol' => 'nullable',
            'image' => 'nullable',
            'presition' => 'required',
            'note' => 'nullable',
        ]);

         $path = $request->file('image')->store('games', 'public');


        $imageUrl = asset('storage/' . $path);

        $currency = new Currency;
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->image = $imageUrl;
        $currency->presition = $request->presition;
        $currency->note = $request->note;
        $currency->save();
        return response()->json($currency);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency, $id)
    {
        $currency = Currency::find($id);
        return response()->json($currency);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency, $id)
    {
        $currency = Currency::findOrFail($id);

        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->presition = $request->presition;
        $currency->note = $request->note;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('games', 'public');
            // Generate public URL
            $imageUrl = asset('storage/' . $path);
            $currency->image = $imageUrl;
        }

        $currency->save();

        return response()->json($currency);
    }

    public function destroy(Currency $currency, $id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return response()->json(['message' => 'Currency deleted successfully']);
    }
}
