<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\EvalComponentController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  Route::get('/create-criteria', [CriteriaController::class, 'create'])->name('criteria.create');
  Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
  Route::get('/criteria/{id}', [CriteriaController::class, 'edit'])->name('criteria.edit');
  Route::patch('/criteria/{id}', [CriteriaController::class, 'update'])->name('criteria.update');
  Route::delete('/criteria/{id}', [CriteriaController::class, 'destroy'])->name('criteria.destroy');
});

Route::middleware('auth')->group(function() {
  Route::get('/create-eval-component',[EvalComponentController::class, 'create'])->name('component.create');
  Route::post('/create-eval-component',[EvalComponentController::class, 'store'])->name('component.store');
  Route::delete('/eval-component/{id}',[EvalComponentController::class, 'destroy'])->name('component.destroy');
});

Route::middleware(['auth', 'verified', 'evaluator.only'])->group(function () {
  Route::get('/evaluate/{id}', [EvaluationController::class, 'create'])->name('evaluation.create');
  Route::post('/evaluate', [EvaluationController::class, 'store'])->name('evaluation.store');
  Route::post('/evaluate/all', [EvaluationController::class, 'bulkStore'])
    ->name('evaluation.bulkStore');

});

Route::get('/activity', function () {
  $activities = Activity::latest()->get();
  return view('activity', compact('activities'));
})->middleware(['auth', 'verified', 'admin.only']);
