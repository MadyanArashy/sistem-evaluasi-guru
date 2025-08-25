<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\User;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
  $teachers = Teacher::limit(5)->get();
  if (EvalComponent::count() > 0){
    $evaluationCount = Evaluation::count() / EvalComponent::count();
  }
  $scores = [];

    foreach ($teachers as $teacher) {
      $components = EvalComponent::all();

      $weightedSum = 0;
      $totalWeight = 0;

      foreach ($components as $component) {
        $score = Evaluation::where('component_id', $component->id)
          ->where('teacher_id', $teacher->id)
          ->latest()
          ->first()?->score;

        $scoreVal = $score ? $score / 10 : 0;
        $weightVal = floatval($component->weight);

        $weightedSum += $scoreVal * $weightVal;
        $totalWeight += $weightVal;
      }

      $finalScore = $totalWeight > 0 ? round($weightedSum / $totalWeight, 2) : 0;
      $scores[$teacher->id] = $finalScore;
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
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
    Route::get('/create-teacher', [TeacherController::class, 'create'])->name('teacher.create');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
});

Route::get('/admin', function () {
  $criterias = Criteria::all();
  $teachers = Teacher::all();
  $components = EvalComponent::all();
  $evaluations = Evaluation::all();
  $users = User::all();
  return view('admin', compact('criterias', 'teachers', 'components', 'evaluations', 'users'));
})->middleware(['auth', 'verified', 'admin.only'])->name('admin');

require __DIR__.'/auth.php';
require __DIR__.'/rashy.php';
require __DIR__.'/kafka.php';
require __DIR__.'/gufron.php';
