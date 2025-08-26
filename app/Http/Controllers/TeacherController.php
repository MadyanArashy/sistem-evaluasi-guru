<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Evaluation;
use App\Models\Teacher;
use App\Models\EvalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if user has role 'guru' and has a teacher_id
        if (Auth::check() && Auth::user()->role === 'guru' && Auth::user()->teacher_id) {
            return redirect()->route('teacher.show', ['id' => Auth::user()->teacher_id]);
        }

        $teachers = Teacher::all();
        $scores = [];

        foreach ($teachers as $teacher) {
            $components = EvalComponent::all();

            $weightedSum = 0;
            $totalWeight = 0;

            foreach ($components as $component) {
                $score = Evaluation::where('component_id', $component->id)
                ->where('teacher_id', $teacher->id)
                ->latest()
                ->first()?->score;

                $scoreVal = $score ? $score / 10 : 0;
                $weightVal = floatval($component->weight);

                $weightedSum += $scoreVal * $weightVal;
                $totalWeight += $weightVal;
            }

            $finalScore = $totalWeight > 0 ? round($weightedSum / $totalWeight, 2) : 0;
            $scores[$teacher->id] = $finalScore;
        }

        // 🔹 pass $scores to the view
        return view('index_teacher', compact('teachers', 'scores'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk menambah guru');
        }
        
        return view('create_teacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk menambah guru');
        }
        
        $validated = $request->validate([
            "name" => "required|string",
            "degree" => "required|string",
            "subject" => "required|string",
        ]);

        Teacher::create($validated);

        return redirect()->route('teacher.index')->with('success','Guru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        // Check if user is guru and trying to access another teacher's data
        if (Auth::check() && Auth::user()->role === 'guru' && Auth::user()->teacher_id != $id) {
            return redirect()->route('teacher.show', ['id' => Auth::user()->teacher_id])
                ->with('error', 'Anda hanya dapat melihat data guru Anda sendiri');
        }
        
        $components = EvalComponent::all();
        $criterias = Criteria::all();
        return view('view_teacher', compact('teacher', 'components', 'criterias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit guru');
        }
        
        return view('edit_teacher', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate guru');
        }
        
        $validated = $request->validate([
            "name" => "required|string",
            "degree" => "required|string",
            "subject" => "required|string",
        ]);

        $teacher->update($validated);

        return redirect()->route('teacher.index')->with('success', 'Guru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Restrict access for guru users
        if (Auth::check() && Auth::user()->role === 'guru') {
            return redirect()->route('teacher.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus guru');
        }
        
        $teacher = Teacher::findOrFail($id);
        $teacher->deleteOrFail();
        return redirect()->route('teacher.index')->with('success', 'Teacher successfully deleted');
    }
}
