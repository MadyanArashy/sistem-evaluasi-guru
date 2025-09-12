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
    $user = Auth::user();
    if ($user && $user->role === 'guru') {
        $teachers = Teacher::where('id', $user->teacher_id)->get();
    } else {
        $teachers = Teacher::all();
    }

    // Get current academic year (latest year in semesters)
    $currentYear = \App\Models\Semester::orderBy('tahun_ajaran', 'desc')->first()?->tahun_ajaran;

    // Get semesters for current academic year (Ganjil and Genap)
    $currentSemesters = \App\Models\Semester::where('tahun_ajaran', $currentYear)
        ->orderBy('semester', 'asc')
        ->get();

    $scores = [];

    foreach ($teachers as $teacher) {
        $scores[$teacher->id] = [];

        foreach ($currentSemesters as $semester) {
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
                        ->where('semester_id', $semester->id)
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
            $scores[$teacher->id][$semester->semester] = round($finalScore, 2);
        }
    }

    return view('index_teacher', compact('teachers', 'scores', 'currentYear', 'currentSemesters'));
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

        // Get all semesters where this teacher has evaluations
        $teacherSemesters = \App\Models\Semester::whereHas('evaluations', function($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
        ->orderBy('tahun_ajaran', 'desc')
        ->orderBy('semester', 'desc')
        ->get();

        // Calculate scores for each semester
        $semesterScores = [];
        foreach ($teacherSemesters as $semester) {
            $score = $this->calculateTeacherScore($teacher->id, $semester->id);
            $semesterScores[$semester->id] = [
                'score' => $score,
                'semester_name' => $semester->semester == 1 ? 'Ganjil' : 'Genap',
                'tahun_ajaran' => $semester->tahun_ajaran,
                'semester' => $semester
            ];
        }

        // Calculate overall score (latest semester)
        $latestSemester = $teacherSemesters->first();
        $overallScore = $latestSemester ? $this->calculateTeacherScore($teacher->id, $latestSemester->id) : 0;

        return view('view_teacher', compact(['teacher', 'evalcomponents', 'criterias', 'semesterScores', 'overallScore']));
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

        // Get latest semester for this teacher
        $latestSemester = \App\Models\Semester::whereHas('evaluations', function($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
        ->orderBy('tahun_ajaran', 'desc')
        ->orderBy('semester', 'desc')
        ->first();

        $score = $latestSemester ? $this->calculateTeacherScore($teacher->id, $latestSemester->id) : 0;
        $semester = $latestSemester;

        // Load PDF view
        $pdf = Pdf::loadView('pdf.teacher_report', compact(['teacher', 'evalcomponents', 'criterias', 'score', 'semester']));

        // Return PDF download
        return $pdf->download('laporan_guru_' . $teacher->name . '.pdf');
    }

    /**
 * Promote teacher from "Calon Guru Tetap" to "Guru Tetap"
 *
 * @param int $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function promote($id)
{
    try {
        $teacher = Teacher::findOrFail($id);

        // Check if user is authorized (evaluator role)
        if (!auth()->check() || auth()->user()->role !== 'evaluator') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan promosi guru.');
        }

        // Check if teacher has "Calon Guru Tetap" status
        if ($teacher->status !== 'Calon Guru Tetap') {
            return redirect()->back()->with('error', 'Guru ini tidak memenuhi syarat untuk dipromosikan. Status saat ini: ' . $teacher->status);
        }

        // Update teacher status
        $teacher->update(['status' => 'Guru Tetap']);

        // Log the activity
        $user = auth()->user();
        ActivityLogger::log(
            'teacher promoted',
            "{$user->role} {$user->name} promoted teacher {$teacher->name} ({$teacher->id}) from 'Calon Guru Tetap' to 'Guru Tetap'",
            'update',
            $user->id
        );

        // Log for system monitoring
        \Log::info("Teacher promoted manually", [
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacher->name,
            'promoted_by' => $user->name,
            'promoted_by_id' => $user->id,
            'old_status' => 'Calon Guru Tetap',
            'new_status' => 'Guru Tetap',
            'promotion_date' => now()
        ]);

        return redirect()->back()->with('success', "Guru {$teacher->name} berhasil dipromosikan menjadi Guru Tetap!");

    } catch (\Exception $e) {
        \Log::error('Failed to promote teacher', [
            'teacher_id' => $id,
            'error' => $e->getMessage(),
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('error', 'Terjadi kesalahan saat mempromosikan guru. Silakan coba lagi.');
    }
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
