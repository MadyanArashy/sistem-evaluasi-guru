<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/halaman-guru', function () {
    return view('halamanguru');
})->middleware(['auth', 'verified'])->name('halamanguru');

Route::get('/data-guru', function () {
    return view('dataguru');
})->middleware(['auth', 'verified'])->name('buatguru');


require __DIR__.'/auth.php';
