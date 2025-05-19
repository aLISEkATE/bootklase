<?php


namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
          $students = User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }
    public function create()
    {
        return view('students.create');
    }           
    public function store(Request $request)
    {
    $validated = $request->validate([
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => ['required', Password::min(6)->numbers()->letters()->symbols(), 'confirmed'],
        'avatar' => 'nullable|image|max:2048', // Validate avatar file
    ]);

    if ($request->hasFile('avatar')) {
        $validated['avatar'] = $request->file('avatar')->store('avatars', 'public'); // Store avatar
    }

    User::create($validated);

    return redirect('/students')->with('success', 'Student created successfully!');
    }
    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('students.show', compact('student'));
    }
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('students.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        // Validate the input (recommended)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);
    
        // Update the student
        $student = User::findOrFail($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->save();
    
        // Redirect to the index page (or wherever you prefer)
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
    
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
    public function showGrades($id)
    {
        $student = Student::with('grades.subject')->findOrFail($id);
        return view('students.grades', compact('student'));
    }

    public function updateAvatar(Request $request, Student $student)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            // Update the student's avatar in the database
            $student->avatar = $avatarPath;
            $student->save();
        }

        return redirect()->back()->with('success', 'Avatar updated successfully!');
    }
}
