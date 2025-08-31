<?php

namespace App\Http\Controllers;

use App\Models\EvalComponent;
use App\Models\Criteria;
use App\Models\Teacher;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

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
      try {
        $validated = $request->validate([
          "criteria_id" => "integer|required|exists:criterias,id",
          "name" => "string|required",
          "weight" => "integer|required",
          "description" => "string|required",
        ]);

        $evalcomponent = EvalComponent::create($validated);

        // log the activity
        $user = Auth::user();
        ActivityLogger::log(
          'create criteria',
          "{$user->role} {$user->name} created component \"{$evalcomponent->name}\" ($evalcomponent->id)",
          'create',
          $user->id
        );


        return redirect()->to(route('admin').'#components')->with('success', "Berhasil tambah komponen \"{$evalcomponent->name}\"!");
      } catch (Throwable $e) {
        dd('Error:', $e->getMessage());
      }
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
    public function edit(string $id)
    {
      $evalcomponent = EvalComponent::findOrFail($id);
      $criterias = Criteria::all();
      $evalcomponents = EvalComponent::all();
      $users = User::all();
      return view('edit_evalcomponent', compact('evalcomponent', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      // validasi dulu biar aman
    $validated = $request->validate([
      "criteria_id" => "integer|required|exists:criterias,id",
      "name" => "string|required",
      "weight" => "integer|required",
      "description" => "string|required",
    ]);

    // ambil data lama
    $evalcomponent = EvalComponent::findOrFail($id);

    // update data
    $evalcomponent->update($validated);

    $evalcomponent = $request;

    // log the activity
    $user = Auth::user();
    ActivityLogger::log(
      'edit evalcomponent',
      "{$user->role} {$user->name} edited evalcomponent \"{$evalcomponent->name}\" ($evalcomponent->id)",
      'edit',
      $user->id
    );


    // redirect balik
    return redirect()->route('admin')->with('success', "Berhasil ubah kriteria \"$request->name\"!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $evalcomponent = EvalComponent::findOrFail($id);
      $evalcomponent->deleteOrFail();


      // log the activity
      $user = Auth::user();
      ActivityLogger::log(
        'delete component',
        "{$user->role} {$user->name} deleted component \"{$evalcomponent->name}\" ($evalcomponent->id)",
        'delete',
        $user->id
      );



      return redirect()->to(route('admin').'#components')->with('success', 'Successfully deleted evaluation component!');
    }
}
