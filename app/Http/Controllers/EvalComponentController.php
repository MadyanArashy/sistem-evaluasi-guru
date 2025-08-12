<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\EvalComponent;
use Illuminate\Http\Request;

class EvalComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $criterias = Criteria::all();
      return view('create_evalcomponent', compact('criterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validated = $request->validate([
        "criteria_id" => "integer|required|exists:criterias,id",
        "name" => "string|required",
        "weight" => "integer|required",
        "description" => "string|required",
      ]);

      EvalComponent::create($validated);

      return redirect()->route('admin')->with('success', 'Berhasil tambah eval komponen');
    }

    /**
     * Display the specified resource.
     */
    public function show(EvalComponent $evalComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EvalComponent $evalComponent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvalComponent $evalComponent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvalComponent $evalComponent)
    {
        //
    }
}
