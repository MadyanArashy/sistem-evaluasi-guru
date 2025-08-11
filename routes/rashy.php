<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CriteriaController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/create-criteria', function () {
  return view('create_criteria');
})->name('criteria.create');
Route::post('/teacher', [CriteriaController::class, 'store'])->name('criteria.store');
