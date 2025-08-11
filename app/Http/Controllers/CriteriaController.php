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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
          "name" => "string|required",
          "weight" => "integer|required",
        ]);

        Criteria::create($validated);
        return redirect()->route('admin')->with('success', 'criteria successfully added');
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
      if($criteria->delete()){
        return redirect()->route('admin')->with('success', 'Criteria deleted.');
      } else if (EvalComponent::where('criteria_id', $id)->first()) {
        return redirect()->route('admin')->with('fail', "Delete any eval_component with the $criteria->name ID.");
      }
      else {
        return redirect()->route('admin')->with('fail', "Failed to delete criteria.");
      }
    }
}
