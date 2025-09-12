<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Evaluation;
use App\Models\EvalComponent;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get all semesters as a collection for the filter dropdown
        $allSemesters = Semester::orderByDesc('id')->get();

        // Get teachers based on user role with pagination
        if ($user && $user->role === 'guru') {
            return redirect()->route('teacher.show', $user->teacher_id);
        } else {
            // Add pagination - 10 teachers per page
            $teachers = Teacher::paginate(10);
            $allTeachers = Teacher::all(); // For stats calculation
        }

        // Get filter parameters
        $tahunAjaranFilter = $request->get('tahun_ajaran'); // academic year like '2025-2026' or null for all

        // Get semesters based on filter
        if ($tahunAjaranFilter) {
            // Filter by specific academic year
            $semesters = Semester::where('tahun_ajaran', $tahunAjaranFilter)
                                ->orderBy('tahun_ajaran', 'desc')
                                ->orderBy('semester', 'asc')
                                ->get();
        } else {
            // Show current academic year only (2025-2026) when no filter
            $currentAcademicYear = '2025-2026';
            $semesters = Semester::where('tahun_ajaran', $currentAcademicYear)
                                ->orderBy('semester', 'asc')
                                ->get();
        }

        // Calculate evaluation count
        if (EvalComponent::count() > 0) {
            $evaluationCount = Evaluation::count() / EvalComponent::count();
        } else {
            $evaluationCount = 0;
        }

        // Calculate scores per semester for each teacher (only for current page teachers)
        $scores = [];
        foreach ($teachers as $teacher) {
            $teacherScores = [];

            foreach ($semesters as $semester) {
                $score = $this->calculateTeacherScore($teacher->id, $semester->id);
                $teacherScores[$semester->id] = [
                    'score' => $score,
                    'semester_name' => $this->getSemesterName($semester),
                    'tahun_ajaran' => $semester->tahun_ajaran
                ];
            }

            $scores[$teacher->id] = $teacherScores;
        }

        // Use allTeachers for total count in stats, but teachers (paginated) for display
        $totalTeachers = $allTeachers ?? $teachers;

        return view('home', compact(['teachers', 'evaluationCount', 'scores', 'semesters', 'tahunAjaranFilter', 'totalTeachers', 'allSemesters']));
    }

    private function calculateTeacherScore($teacherId, $semesterId)
    {
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
                    ->where('teacher_id', $teacherId)
                    ->where('semester_id', $semesterId)
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

        return round($finalScore, 2);
    }

    private function getSemesterName($semester)
    {
        return $semester->semester == 1 ? 'Ganjil' : 'Genap';
    }
}
