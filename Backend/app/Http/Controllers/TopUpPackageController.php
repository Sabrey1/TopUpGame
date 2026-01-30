<?php

namespace App\Http\Controllers;

use App\Models\TopUpPackage;
use Illuminate\Http\Request;

class TopUpPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topUpPackages = TopUpPackage::leftJoin(
            'games',
            'topup_packages.game_id',
            '=',
            'games.id'
        )->leftJoin(
            'currencies',
            'topup_packages.currency_id',
            '=',
            'currencies.id',
        )->leftJoin(
            'units',
            'topup_packages.unit_id',
            '=',
            'units.id'
        )
        ->select('topup_packages.*', 'games.name as game_name', 'currencies.name as currency_name', 'currencies.symbol as currency_symbol', 'units.name as unit_name')
        ->get();
        return response()->json($topUpPackages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'fullprice' => 'required',
            'currency_id' => 'required',
            'unit_id' => 'required',

        ]);

         $path = $request->file('image')->store('topUpPackage', 'public');

        // Generate public URL
        $imageUrl = asset('storage/' . $path);


        $topUp = new TopUpPackage();
        $topUp->game_id = $request->game_id;
        $topUp->name = $request->name;
        $topUp->amount = $request->amount;
        $topUp->image = $imageUrl;
        $topUp->fullprice = $request->fullprice;
        $topUp->currency_id = $request->currency_id;
        $topUp->unit_id = $request->unit_id;
        $topUp->description = $request->description;
        $topUp->discount = $request->discount;
        $topUp->best_seller = $request->best_seller ?? 0;
        $topUp->save();

        return response()->json([
            'topUp' => $topUp,
            'message' => 'TopUpPackage created successfully',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(TopUpPackage $topUpPackage, $id)
    {
        $topUp = TopUpPackage::find($id);
        return response()->json([
            'topUp' => $topUp,
            'message' => 'TopUpPackage found successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TopUpPackage $topUpPackage, $id)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'fullprice' => 'required',
            'unit_id' => 'required',
            'currency_id' => 'required',
        ]);

        $topUpPackage = TopUpPackage::findOrFail($id);

        $topUpPackage->name = $request->name;
        $topUpPackage->description = $request->description;
        $topUpPackage->currency_id = $request->currency_id;
        $topUpPackage->game_id = $request->game_id;
        $topUpPackage->amount = $request->amount;
        $topUpPackage->fullprice = $request->fullprice;
        $topUpPackage->unit_id = $request->unit_id;
        $topUpPackage->discount = $request->discount;
        $topUpPackage->best_seller = $request->has('best_seller') ? 1 : 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('topUpPackage', 'public');
            $topUpPackage->image = asset('storage/' . $path);
        }

        $topUpPackage->save();

        return response()->json([
            'topUpPackage' => $topUpPackage,
            'message' => 'Coursel updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopUpPackage $topUpPackage, $id)
    {
        $topUpPackage = TopUpPackage::find($id);
        $topUpPackage->delete();
        return response()->json([
            'topUpPackage' => $topUpPackage,
            'message' => 'TopUpPackage deleted successfully',
        ]);
    }
}
