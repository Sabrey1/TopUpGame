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
        )
        ->select('topup_packages.*', 'games.name as game_name')
        ->get();
        return response()->json($topUpPackages);
    }

    public function store(Request $request)
    {
        $request->valitedate([
            'game_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'Unit' => 'required',
             
        ]);

         $path = $request->file('image')->store('topUpPackage', 'public');

        // Generate public URL
        $imageUrl = asset('storage/' . $path);


        $topUp = new TopUpPackage();
        $topUp->game_id = $request->game_id;
        $topUp->name = $request->name;
        $topUp->amount = $request->amount;
        $topUp->image = $imageUrl;
        $topUp->price = $request->price;
        $topUp->Unit = $request->Unit;
        $topUp->discount = $request->discount;
        $topUp->best_seller = $request->best_seller;
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
        $request->valitedate([
            'game_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'Unit' => 'required',
        ]);

        $topUpPackage = TopUpPackage::findOrFail($id);

        $topUpPackage->name = $request->name;
        $topUpPackage->description = $request->description;
        $topUpPackage->game_id = $request->game_id;
        $topUpPackage->amount = $request->amount;
        $topUpPackage->price = $request->price;
        $topUpPackage->Unit = $request->Unit;
        $topUpPackage->discount = $request->discount;
        $topUpPackage->best_seller = $request->best_seller;

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
