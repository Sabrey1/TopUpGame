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
        // $coursel = Coursel::limit(4)->get();
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


        $path = $request->file('image')->store('coursels', 'public');

        // Generate public URL
        $imageUrl = asset('storage/' . $path);

        $coursel = new Coursel();
        $coursel->title = $request->title;
        $coursel->image = $imageUrl;
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ]);

        $coursel = Coursel::findOrFail($id);

        $coursel->title = $request->title;
        $coursel->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('coursels', 'public');
            $coursel->image = asset('storage/' . $path);
        }

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
