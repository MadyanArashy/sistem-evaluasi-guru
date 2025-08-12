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
    Route::get('/create-user', function () {
        return view('create_user');
    })->name('user.create');
    Route::post('/create-user', [AdminUserController::class, 'store'])->name('user.store');
    Route::delete('/create-user/{id}', [AdminUserController::class, 'destroy'])->name('user.destroy');
});

