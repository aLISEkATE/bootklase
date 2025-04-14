<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;


class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'subject'])->get(); 
        
        return view('grades.index', compact('grades'));
    }
    public function create()
{
    $students = Student::all();
    $subjects = Subject::all();
    return view('grades.create', compact('students', 'subjects'));
}

    public function store(Request $request)
    {
        // Validate and store the grade data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        // Store the grade in the database
        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');
    }
    public function show($id)
    {
        // Retrieve and display the grade details
        $grade = Grade::findOrFail($id);
        return view('grades.show', compact('grade'));
    }
    public function edit($id)
    {
        // Retrieve the grade for editing
        $grade = Grade::findOrFail($id);
        return view('grades.edit', compact('grade'));
    }
    public function update(Request $request, $id)
    {
        // Validate and update the grade data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        // Update the grade in the database
         $grade = Grade::findOrFail($id);
         $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }
    public function destroy($id)
    {
        // Delete the grade from the database
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
    public function filter(Request $request)
    {
        // Filter grades based on the request parameters
        $grades = Grade::query();

        if ($request->has('student_id')) {
             $grades->where('student_id', $request->input('student_id'));
        }

        if ($request->has('subject_id')) {
             $grades->where('subject_id', $request->input('subject_id'));
        }

        if ($request->has('date')) {
            $grades->whereDate('date', $request->input('date'));
        }

        return view('grades.index', compact('grades'));
    }
}
