<?php


namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }
    public function create()
    {
        return view('students.create');
    }           
    public function store(Request $request)
    {
        // Validate the input (recommended)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255'
        ]);
    
        // Create and save the new student
        $student = new Student();
        
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->save();
    
        // Redirect to the index page (or wherever you prefer)
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        // Validate the input (recommended)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255'
        ]);
    
        // Update the student
        $student = Student::findOrFail($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->save();
    
        // Redirect to the index page (or wherever you prefer)
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
    
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
    public function showGrades($id)
    {
        $student = Student::with('grades.subject')->findOrFail($id);
        return view('students.grades', compact('student'));
    }

}
