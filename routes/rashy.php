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
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  Route::get('/create-criteria', [CriteriaController::class, 'create'])->name('criteria.create');
  Route::post('/criteria', [CriteriaController::class, 'store'])->name('criteria.store');
  Route::delete('/criteria/{id}', [CriteriaController::class, 'destroy'])->name('criteria.destroy');
});

Route::get('testing-arashy', function () {
  $criterias = Criteria::all();
  return view('testing-arashy', compact('criterias'));
});

Route::middleware('auth')->group(function() {
  Route::get('create-eval-component',[EvalComponentController::class, 'create'])->name('component.create');
});
