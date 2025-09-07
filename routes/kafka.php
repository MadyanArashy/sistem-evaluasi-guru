<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/create-user', [AdminUserController::class, 'create'])->name('user.create');
    Route::get('/edit-user/{id}', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::post('/create-user', [AdminUserController::class, 'store'])->name('user.store');
    Route::put('/edit-user/{id}', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('/create-user/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
});

