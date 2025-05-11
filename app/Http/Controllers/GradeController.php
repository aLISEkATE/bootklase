<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;


class GradeController extends Controller
{
    
    public function index(Request $request)
    {
        $grades = Grade::with(['subject', 'student']);
        $user = Auth::user();

        if ($request->filled('student_id')) {
            $grades->where('student_id', $request->student_id);
        }
    
        if ($request->filled('subject_id')) {
            $grades->where('subject_id', $request->subject_id);
        }
    
        // Sorting logic
        $sort_by = $request->input('sort_by', 'grade'); // default to sorting by grade
        $sort_order = $request->input('sort_order', 'asc'); // default to ascending
    
        // Only allow valid columns
        if (in_array($sort_by, ['grade', 'student_name'])) {
            if ($sort_by === 'student_name') {
                // Sort by related student's last name
                $grades = $grades->get()->sortBy(fn($g) => $g->student->last_name, SORT_REGULAR, $sort_order === 'desc');
            } else {
                $grades = $grades->orderBy($sort_by, $sort_order)->get();
            }
        } else {
            $grades = $grades->get();
        }
    
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
    
        return view('grades.index', compact('grades', 'students', 'subjects'));
    }
    

    public function create()
{
    $students = User::where('role', 'student')->get();
    $subjects = Subject::all();
    return view('grades.create', compact('students', 'subjects'));
}

    public function store(Request $request)
    {
        // Validate and store the grade data
        $request->validate([
            'student_id' => 'required|exists:users,id',
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
