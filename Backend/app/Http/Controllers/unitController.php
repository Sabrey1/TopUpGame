<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::all();
        return response()->json($unit);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);
        $unit = Unit::create([
            'name' => $request->name,
            'note' => $request->note,
        ]);
        return response()->json($unit);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit, $id)
    {
        $unit = Unit::find($id);
        return response()->json($unit);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit , $id)
    {
        $unit = Unit::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $unit->name = $request->name;
        $unit->note = $request->note;
        $unit->save();

        return response()->json($unit);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return response()->json(['message' => 'Unit deleted successfully']);
    }
}
