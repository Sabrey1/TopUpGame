<?php

namespace App\Http\Controllers;

use App\Models\Coursel;
use Illuminate\Http\Request;

class CourselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursel = Coursel::all();
        return response()->json($coursel);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'title' => 'required',
        ]);

        $coursel = new Coursel();
        $coursel->title = $request->title;
        $coursel->image = $request->image;
        $coursel->description = $request->description;
        $coursel->save();

        return response()->json([
            'coursel' => $coursel,
            'message' => 'Coursel created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coursel $coursel, $id)
    {
        $coursel = Coursel::find($id);
        return response()->json([
            'coursel' => $coursel,
            'message' => 'Coursel found successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coursel $coursel, $id)
    {
        $validate = request()->validate([
            'title' => 'required',
        ]);

        $coursel = Coursel::find($id);
        $coursel->title = $request->title;
        $coursel->image = $request->image;
        $coursel->description = $request->description;
        $coursel->save();

        return response()->json([
            'coursel' => $coursel,
            'message' => 'Coursel updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursel $coursel, $id)
    {
        $coursel = Coursel::find($id);
        $coursel->delete();
        return response()->json([
            'coursel' => $coursel,
            'message' => 'Coursel deleted successfully',
        ]);
    }
}
