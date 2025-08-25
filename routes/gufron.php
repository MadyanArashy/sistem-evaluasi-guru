<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

// Routes for editing teachers
Route::middleware('auth')->group(function () {
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
});


