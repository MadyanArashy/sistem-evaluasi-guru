<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Models\Criteria;
use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

// Route untuk edit criteria
Route::get('/criteria/{criteria}/edit', function(Criteria $criteria) {
    return view('edit_criteria', compact('criteria'));
})->name('criteria.edit');

Route::put('/criteria/{criteria}', function(Criteria $criteria) {
    $validated = request()->validate([
        "weight" => "integer|required",
        "name" => "string|required",
        "description" => "string|required",
        "style" => "string|required",
        "icon" => "string|required",
    ]);

    $criteria->update($validated);

    return redirect()->route('admin')->with('success', "Kriteria $criteria->name berhasil diupdate");
})->name('criteria.update');
