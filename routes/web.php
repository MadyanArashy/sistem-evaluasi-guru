<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\Semester;
use App\Models\User;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
  $user = Auth::user();
  if ($user && $user->role === 'guru') {
      $teachers = Teacher::where('id', $user->teacher_id)->get();
  } else {
      $teachers = Teacher::limit(5)->get();
  }
  if (EvalComponent::count() > 0){
    $evaluationCount = Evaluation::count() / EvalComponent::count();
  } else {
    $evaluationCount = 0;
  }
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
  return view('home', compact('teachers', 'evaluationCount', 'scores'));
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman-Halaman guru
Route::middleware('auth')->group(function () {
    Route::get('/teacher/show/{id}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::get('/teacher/report/{id}', [TeacherController::class, 'report'])->name('teacher.report');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::get('/create-teacher', [TeacherController::class, 'create'])->name('teacher.create');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
});

Route::get('/admin', function () {
  $criterias = Criteria::all();
  $teachers = Teacher::all();
  $evalcomponents = EvalComponent::all();
  $evaluations = Evaluation::all();
  $users = User::all();
  $semesters = Semester::all();
  return view('admin', compact('criterias', 'teachers', 'evalcomponents', 'evaluations', 'users', 'semesters'));
})->middleware(['auth', 'verified', 'admin.only'])->name('admin');

require __DIR__.'/auth.php';
require __DIR__.'/rashy.php';
require __DIR__.'/kafka.php';
require __DIR__.'/gufron.php';
