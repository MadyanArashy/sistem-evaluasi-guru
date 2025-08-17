<?php

namespace App\Http\Controllers;

use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Http\Request;

class EvaluationController extends Controller
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
    public function create(string $id)
    {
      $teacher = Teacher::findOrFail($id);
      $components = EvalComponent::all();

      return view('evaluation', compact('teacher', 'components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        "teacher_id"   => "required|integer|exists:teachers,id",
        "component_id" => "required|integer|exists:eval_components,id",
        "user_id"      => "required|integer|exists:users,id",
        "score"        => "required|integer|min:1|max:5",
      ]);

      $evaluation = Evaluation::create($validated);

      if ($request->ajax()) {
        return response()->json([
          'success' => true,
          'message' => 'Evaluasi berhasil disimpan',
          'data'    => $evaluation
        ], 201);
      }

      return redirect()->back()->with('success', 'Evaluasi berhasil disimpan');
    }

  public function bulkStore(Request $request)
  {
    try {
      $validated = $request->validate([
        'evaluations' => 'required|array|min:1',
        'evaluations.*.teacher_id'   => 'required|integer|exists:teachers,id',
        'evaluations.*.component_id' => 'required|integer|exists:eval_components,id',
        'evaluations.*.user_id'      => 'required|integer|exists:users,id',
        'evaluations.*.score'        => 'required|integer|min:1|max:5',
      ]);

      $now = now();
      $evaluations = array_map(function ($item) use ($now) {
        $item['created_at'] = $now;
        $item['updated_at'] = $now;
        return $item;
      }, $validated['evaluations']);

      Evaluation::insert($evaluations);

      return response()->json([
        'success' => true,
        'message' => 'Semua evaluasi berhasil disimpan',
        'count'   => count($evaluations),
      ], 201);

    } catch (\Throwable $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], 500);
    }
  }




    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
