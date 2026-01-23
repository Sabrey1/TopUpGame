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
    public function show(Coursel $coursel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursel $coursel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coursel $coursel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursel $coursel)
    {
        //
    }
}
