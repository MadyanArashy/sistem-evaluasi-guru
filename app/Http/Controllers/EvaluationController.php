<?php

namespace App\Http\Controllers;

use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use App\Models\Semester;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;
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
      $evalcomponents = EvalComponent::all();

      return view('evaluation', compact('teacher', 'evalcomponents'));
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
            'evaluations.*.semester_id' => 'required|integer|exists:semesters,id',
            'evaluations.*.user_id'      => 'required|integer|exists:users,id',
            'evaluations.*.score'        => 'required|numeric|min:0|max:50',
        ]);

        $now = now();
        $evaluations = array_map(function ($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $validated['evaluations']);

        Evaluation::insert($evaluations);

        // ambil teacher dari data pertama
        $teacherId = $validated['evaluations'][0]['teacher_id'];
        $teacher   = Teacher::find($teacherId);

        // Check and update teacher status if criteria met
        $this->checkAndUpdateTeacherStatus($teacherId);

        // log the activity
        $user = Auth::user();

        ActivityLogger::log(
            'create evaluations',
            "{$user->role} {$user->name} created evaluations for teacher {$teacher->name} ({$teacher->id})",
            'create',
            $user->id
        );

        return response()->json([
            'success' => true,
            'message' => 'Semua evaluasi berhasil disimpan',
        ], 201);

    } catch (\Throwable $e) {
        \Log::error('Bulk store evaluations failed', ['error' => $e]);
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat menyimpan evaluasi',
        ], 500);
    }
}

/**
 * Check if teacher meets criteria for status update and update if necessary
 *
 * @param int $teacherId
 * @return void
 */
/**
 * Check if teacher meets criteria for status update and update if necessary
 *
 * @param int $teacherId
 * @return void
 */
private function checkAndUpdateTeacherStatus($teacherId)
{
    try {
        $teacher = Teacher::find($teacherId);
        if (!$teacher) return;

        if ($teacher->status === 'Calon Guru Tetap') {
            return;
        }

        // Get all semesters with evaluations for this teacher
        $semestersWithEvaluations = Semester::whereHas('evaluations', function($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })
        ->orderBy('tahun_ajaran', 'asc')
        ->orderBy('id', 'asc')
        ->pluck('id');

        // Require at least 4 semesters
        if ($semestersWithEvaluations->count() < 4) return;

        // Take the latest 4 semesters
        $latestFourSemesters = $semestersWithEvaluations->take(-4);

        $semesterAverages = [];
        foreach ($latestFourSemesters as $semesterId) {
            $avg = $this->calculateTeacherSemesterAverage($teacherId, $semesterId);
            if ($avg > 0) {
                $semesterAverages[] = $avg;
            }
        }

        if (count($semesterAverages) < 4) return;

        // ✅ New rule: ALL 4 semester averages must be >= 4.0
        $allAboveFour = collect($semesterAverages)->every(fn($avg) => $avg >= 4.0);

        if ($allAboveFour) {
            $teacher->update(['status' => 'Calon Guru Tetap']);

            $user = Auth::user();
            ActivityLogger::log(
                'teacher status updated',
                "Teacher {$teacher->name} ({$teacher->id}) status automatically updated to 'Calon Guru Tetap'. Semester averages: " . implode(', ', $semesterAverages),
                'update',
                $user->id
            );

            \Log::info("Teacher status updated", [
                'teacher_id' => $teacherId,
                'teacher_name' => $teacher->name,
                'new_status' => 'Calon Guru Tetap',
                'semester_averages' => $semesterAverages,
                'semesters' => $latestFourSemesters->toArray()
            ]);
        }

    } catch (\Exception $e) {
        \Log::error('Failed to check/update teacher status', [
            'teacher_id' => $teacherId,
            'error' => $e->getMessage()
        ]);
    }
}



/**
 * Calculate teacher's average score for a specific academic year
 *
 * @param int $teacherId
 * @param string $academicYear
 * @return float
 */
private function calculateTeacherAcademicYearAverage($teacherId, $academicYear)
{
    try {
        // Get all evaluations for this teacher in the specific academic year
        $evaluations = Evaluation::whereHas('semester', function($query) use ($academicYear) {
            $query->where('tahun_ajaran', $academicYear);
        })
        ->where('teacher_id', $teacherId)
        ->get();

        if ($evaluations->isEmpty()) {
            return 0;
        }

        // Calculate average score for the academic year
        $totalScore = $evaluations->sum('score');
        $average = $totalScore / $evaluations->count();

        // Convert from 50-point scale to 5-point scale for comparison
        return ($average / 50) * 5;

    } catch (\Exception $e) {
        \Log::error('Failed to calculate academic year average', [
            'teacher_id' => $teacherId,
            'academic_year' => $academicYear,
            'error' => $e->getMessage()
        ]);
        return 0;
    }
}

/**
 * Calculate teacher's average score for a specific semester
 *
 * @param int $teacherId
 * @param int $semesterId
 * @return float
 */
private function calculateTeacherSemesterAverage($teacherId, $semesterId)
{
    // Group components by criteria (same logic as in HomeController)
    $evalComponents = EvalComponent::with('criteria')->get();
    $criteriaGroups = $evalComponents->groupBy('criteria_id');

    $finalScore = 0;

    // Calculate score for each criteria
    foreach ($criteriaGroups as $criteriaId => $evalComponentsGroup) {
        $criteria = $evalComponentsGroup->first()->criteria;
        $criteriaWeight = floatval($criteria->weight); // Bobot kriteria (0-100)

        $criteriaWeightedSum = 0;
        $criteriaTotalWeight = 0;

        // Calculate weighted average within criteria
        foreach ($evalComponentsGroup as $evalComponent) {
            $evaluation = Evaluation::where('component_id', $evalComponent->id)
                ->where('teacher_id', $teacherId)
                ->where('semester_id', $semesterId)
                ->latest()
                ->first();

            $scoreVal = $evaluation ? ($evaluation->score / 10) : 0; // Convert to 1-5 scale
            $evalComponentWeight = floatval($evalComponent->weight); // Bobot komponen dalam kriteria (0-100)

            $criteriaWeightedSum += $scoreVal * $evalComponentWeight;
            $criteriaTotalWeight += $evalComponentWeight;
        }

        // Normalize criteria score (0-5 scale)
        $criteriaScore = $criteriaTotalWeight > 0 ?
            ($criteriaWeightedSum / $criteriaTotalWeight) : 0;

        // Apply criteria weight to overall score
        $finalScore += ($criteriaScore * $criteriaWeight) / 100;
    }

    return round($finalScore, 2);
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
