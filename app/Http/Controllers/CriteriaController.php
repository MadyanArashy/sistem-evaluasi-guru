<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\EvalComponent;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $criterias = Criteria::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_criteria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
    try {
    $validated = $request->validate([
        "weight" => "integer|required",
        "name" => "string|required",
        "description" => "string|required",
        "style" => "string|required",
        "icon" => "string|required",
    ]);

    $criteria = Criteria::create($validated);

        return redirect()->route('admin')->with('success', "criteria $request->name successfully added");
    } catch (\Throwable $e) {
        dd('Error:', $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
  {
      $criteria = Criteria::findOrFail($id);

      // Check if there are related EvalComponent rows first
      if (EvalComponent::where('criteria_id', $id)->exists()) {
          return redirect()
              ->route('admin')
              ->with('fail', "Delete any EvalComponent with the '{$criteria->name}' ID before deleting.");
      }

      // Now safe to delete
      if ($criteria->delete()) {
          return redirect()
              ->route('admin')
              ->with('success', 'Criteria deleted.');
      }

      return redirect()
          ->route('admin')
          ->with('fail', 'Failed to delete criteria.');
  }

}
