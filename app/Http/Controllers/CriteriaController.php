<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\EvalComponent;
use Illuminate\Http\Request;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $criterias = Criteria::all();
      return view('criteria.index', compact('criterias'));
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

    // log the activity
    $user = Auth::user();
    ActivityLogger::log(
      'create criteria',
      "{$user->role} {$user->name} added criteria \"{$criteria->name}\" ($criteria->id)",
      'create',
      $user->id
    );

    return redirect()->to(route('admin').'#criterias')
      ->with('success', "Berhasil tambah kriteria {$criteria->name}");
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
    public function edit(string $id)
    {
        $criteria = Criteria::findOrFail($id);
        return view('edit_criteria', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // validasi dulu biar aman
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'weight'      => 'required|numeric|min:0',
        'icon'        => 'nullable|string',
        'style'       => 'nullable|string',
    ]);

    // ambil data lama
    $criteria = Criteria::findOrFail($id);

    // update data
    $criteria->update($validated);

    $criteria = $request;

    // log the activity
    $user = Auth::user();
    ActivityLogger::log(
      'edit criteria',
      "{$user->role} {$user->name} edited criteria \"{$criteria->name}\" ($criteria->id)",
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
    $criteria = Criteria::findOrFail($id);

    if ($criteria->delete()) {
      // log the activity
      $user = Auth::user();
      ActivityLogger::log(
        'delete criteria',
        "{$user->role} {$user->name} deleted criteria \"{$criteria->name}\" ($criteria->id)",
        'delete',
        $user->id
      );

      return redirect()
        ->route('admin')
        ->with('success', 'Berhasil hapus kriteria!.');
    }

    return redirect()
      ->route('admin')
      ->with('fail', 'Gagal hapus kriteria.');
}


}
