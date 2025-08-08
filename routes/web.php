<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
  $teachers = Teacher::limit(5)->get();
  return view('home', compact('teachers'));
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
    Route::get('/create-teacher', [TeacherController::class, 'create'])->name('teacher.create');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
});

Route::get('/admin', function () {
  $criterias = Criteria::all();
  $teachers = Teacher::all();
  $eval_components = EvalComponent::all();
  $evaluations = Evaluation::all();
  return view('admin', compact('criterias', 'teachers', 'eval_components', 'evaluations'));
})->middleware(['auth', 'verified'])->name('admin');

require __DIR__.'/auth.php';
