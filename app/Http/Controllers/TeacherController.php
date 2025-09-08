<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Teacher;
use App\Models\EvalComponent;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
  {
    $teachers = Teacher::all();
    $scores = [];

    foreach ($teachers as $teacher) {
        // Group components by criteria
        $evalcomponents = EvalComponent::with('criteria')->get();
        $criteriaGroups = $evalcomponents->groupBy('criteria_id');

        $finalScore = 0;

        // Calculate score for each criteria
        foreach ($criteriaGroups as $criteriaId => $evalcomponentsGroup) {
            $criteria = $evalcomponentsGroup->first()->criteria;
            $criteriaWeight = floatval($criteria->weight); // Bobot kriteria (0-100)

            $criteriaWeightedSum = 0;
            $criteriaTotalWeight = 0;

            // Calculate weighted average within criteria
            foreach ($evalcomponentsGroup as $evalcomponent) {
                $evaluation = Evaluation::where('component_id', $evalcomponent->id)
                    ->where('teacher_id', $teacher->id)
                    ->latest()
                    ->first();

                $scoreVal = $evaluation ? ($evaluation->score / 10) : 0; // Convert back to 1-5 scale
                $evalcomponentWeight = floatval($evalcomponent->weight); // Bobot komponen dalam kriteria (0-100)

                $criteriaWeightedSum += $scoreVal * $evalcomponentWeight;
                $criteriaTotalWeight += $evalcomponentWeight;
            }

            // Normalize criteria score (0-5 scale)
            $criteriaScore = $criteriaTotalWeight > 0 ?
                ($criteriaWeightedSum / $criteriaTotalWeight) : 0;

            // Apply criteria weight to overall score
            $finalScore += ($criteriaScore * $criteriaWeight) / 100;
        }
        $scores[$teacher->id] = round($finalScore, 2);
    }

    return view('index_teacher', compact('teachers', 'scores'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk menambah guru');
        }

        return view('create_teacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
          "name" => "required|string",
          "degree" => "required|string",
          "subject" => "required|string",
        ]);

        $teacher = Teacher::create($validated);

        // log the activity
        $user = Auth::user();
        ActivityLogger::log(
          'create teacher',
          "{$user->role} {$user->name} created teacher \"{$teacher->name}\" ($teacher->id)",
          'create',
          $user->id
        );

        return redirect()->route('teacher.index')->with('success','Guru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Check if user is guru and trying to access another teacher's data
        if (Auth::check() && Auth::user()->role === 'guru' && Auth::user()->teacher_id != $id) {
            return redirect()->route('teacher.show', ['id' => Auth::user()->teacher_id])
                ->with('error', 'Anda hanya dapat melihat data guru Anda sendiri');
        }

        $evalcomponents = EvalComponent::all();
        $criterias = Criteria::all();

         // Group components by criteria
        $evalcomponents = EvalComponent::with('criteria')->get();
        $criteriaGroups = $evalcomponents->groupBy('criteria_id');

        $finalScore = 0;

        // Calculate score for each criteria
        foreach ($criteriaGroups as $criteriaId => $evalcomponentsGroup) {
            $criteria = $evalcomponentsGroup->first()->criteria;
            $criteriaWeight = floatval($criteria->weight); // Bobot kriteria (0-100)

            $criteriaWeightedSum = 0;
            $criteriaTotalWeight = 0;

            // Calculate weighted average within criteria
            foreach ($evalcomponentsGroup as $evalcomponent) {
                $evaluation = Evaluation::where('component_id', $evalcomponent->id)
                    ->where('teacher_id', $teacher->id)
                    ->latest()
                    ->first();

                $scoreVal = $evaluation ? ($evaluation->score / 10) : 0; // Convert back to 1-5 scale
                $evalcomponentWeight = floatval($evalcomponent->weight); // Bobot komponen dalam kriteria (0-100)

                $criteriaWeightedSum += $scoreVal * $evalcomponentWeight;
                $criteriaTotalWeight += $evalcomponentWeight;
            }

            // Normalize criteria score (0-5 scale)
            $criteriaScore = $criteriaTotalWeight > 0 ?
                ($criteriaWeightedSum / $criteriaTotalWeight) : 0;

            // Apply criteria weight to overall score
            $finalScore += ($criteriaScore * $criteriaWeight) / 100;
        }
        $score = round($finalScore, 2);
        return view('view_teacher', compact(['teacher', 'evalcomponents', 'criterias', 'score']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit guru');
        }

        return view('edit_teacher', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate guru');
        }

        $validated = $request->validate([
            "name" => "required|string",
            "degree" => "required|string",
            "subject" => "required|string",
        ]);

        $teacher = Teacher::findOrFail($id);

        $teacher->update($validated);

        // log the activity
        $user = Auth::user();
        ActivityLogger::log(
          'edit teacher',
          "{$user->role} {$user->name} edited teacher \"{$teacher->name}\" ($teacher->id)",
          'edit',
          $user->id
        );

        return redirect()->route('teacher.index')->with('success', 'Guru berhasil diperbarui!');
    }

    /**
     * Generate PDF report for the specified teacher.
     */
    public function report(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Check if user is guru and trying to access another teacher's data
        if (Auth::check() && Auth::user()->role === 'guru' && Auth::user()->teacher_id != $id) {
            return redirect()->route('teacher.show', ['id' => Auth::user()->teacher_id])
                ->with('error', 'Anda hanya dapat melihat data guru Anda sendiri');
        }

        $evalcomponents = EvalComponent::all();
        $criterias = Criteria::all();

         // Group components by criteria
        $evalcomponents = EvalComponent::with('criteria')->get();
        $criteriaGroups = $evalcomponents->groupBy('criteria_id');

        $finalScore = 0;

        // Calculate score for each criteria
        foreach ($criteriaGroups as $criteriaId => $evalcomponentsGroup) {
            $criteria = $evalcomponentsGroup->first()->criteria;
            $criteriaWeight = floatval($criteria->weight); // Bobot kriteria (0-100)

            $criteriaWeightedSum = 0;
            $criteriaTotalWeight = 0;

            // Calculate weighted average within criteria
            foreach ($evalcomponentsGroup as $evalcomponent) {
                $evaluation = Evaluation::where('component_id', $evalcomponent->id)
                    ->where('teacher_id', $teacher->id)
                    ->latest()
                    ->first();

                $scoreVal = $evaluation ? ($evaluation->score / 10) : 0; // Convert back to 1-5 scale
                $evalcomponentWeight = floatval($evalcomponent->weight); // Bobot komponen dalam kriteria (0-100)

                $criteriaWeightedSum += $scoreVal * $evalcomponentWeight;
                $criteriaTotalWeight += $evalcomponentWeight;
            }

            // Normalize criteria score (0-5 scale)
            $criteriaScore = $criteriaTotalWeight > 0 ?
                ($criteriaWeightedSum / $criteriaTotalWeight) : 0;

            // Apply criteria weight to overall score
            $finalScore += ($criteriaScore * $criteriaWeight) / 100;
        }
        $score = round($finalScore, 2);

        // Load PDF view
        $pdf = Pdf::loadView('pdf.teacher_report', compact(['teacher', 'evalcomponents', 'criterias', 'score']));

        // Return PDF download
        return $pdf->download('laporan_guru_' . $teacher->name . '.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus guru');
        }

        $teacher = Teacher::findOrFail($id);
        $teacher->deleteOrFail();

        // log the activity
        $user = Auth::user();
        ActivityLogger::log(
          'delete teacher',
          "{$user->role} {$user->name} deleted teacher \"{$teacher->name}\" ($teacher->id)",
          'delete',
          $user->id
        );

        return redirect()->route('teacher.index')->with('success', 'Teacher successfully deleted');
    }
}
