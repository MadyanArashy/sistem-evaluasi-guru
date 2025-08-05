<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tambah-guru', function () {
    return view('buatguru');
})->middleware(['auth', 'verified'])->name('buatguru');

Route::middleware('auth')->group(function () {
    Route::get('/teacher/show/{id}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/create-teacher', [TeacherController::class, 'create'])->name('teacher.create');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
});

Route::get('/halaman-guru', function () {
    return view('halamanguru');
})->middleware(['auth', 'verified'])->name('halamanguru');

Route::get('/data-guru', function () {
    return view(view: 'dataguru');
})->middleware(['auth', 'verified'])->name('dataguru');

require __DIR__.'/auth.php';
