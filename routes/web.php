<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

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
