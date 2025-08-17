<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Teacher;
use App\Models\EvalComponent;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('index_teacher', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_teacher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $components = EvalComponent::all();
        $criterias = Criteria::all();
        return view('view_teacher', compact('teacher', 'components', 'criterias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $teacher = Teacher::findOrFail($id);
       $teacher->deleteOrFail();
       return redirect()->route('teacher.index')->with('success', 'Teacher successfully deleted');
    }
}
