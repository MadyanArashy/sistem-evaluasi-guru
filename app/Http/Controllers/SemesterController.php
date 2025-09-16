<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
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
      $semesters = Semester::orderByDesc('id')->get();
      return view('create_semester',  compact('semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $validated = $request->validate([
        "tahun_ajaran" => [
            "required",
            "regex:/^\d{4}-\d{4}$/", // format 2025-2026
        ],
        "semester" => [
            "required",
            Rule::in([1, 2]),
            Rule::unique('semesters')->where(function ($query) use ($request) {
                return $query->where('tahun_ajaran', $request->tahun_ajaran)
                             ->where('semester', $request->semester);
            }),
        ],
    ], [
        'semester.unique' => 'Semester dengan Tahun Ajaran ini sudah ada.',
    ]);

    // Validasi tambahan: pastikan tahun kedua = tahun pertama + 1
    [$start, $end] = explode('-', $validated['tahun_ajaran']);
    if ((int)$end !== (int)$start + 1) {
        return back()->withErrors([
            'tahun_ajaran' => 'Format tahun ajaran harus berurutan, contoh: 2025-2026',
        ])->withInput();
    }

    Semester::create($validated);

    return redirect()->route('admin')->with('success', 'Semester berhasil disimpan!');
}



    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
  {
    $semester = Semester::findOrFail($id);

    Evaluation::where('semester_id', $semester->id)->delete();

    $semester->delete();

    return redirect()->route('admin')->with('success', 'successfully deleted semester!');
  }

}
