<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
class SubjectController extends Controller
{
  public function index()
  {
    $subjects = Subject::all();
    return view('subjects.index', compact('subjects'));
  }
    public function create()
    {
        return view('subjects.create');
    }
    public function store(Request $request)
    {
        // Validate and store the subject data
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);

        // Store the subject in the database
        Subject::create($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }
    public function show($id)
    {
        // Retrieve and display the subject details
        $subject = Subject::findOrFail($id);
        return view('subjects.show', compact('subject'));
    }
    public function edit($id)
    {
        // Retrieve the subject for editing
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }
    public function update(Request $request, $id)
    {
        // Validate and update the subject data
        $request->validate([
            'subject_name' => 'required|string|max:255',
        
        ]);

        // Update the subject in the database
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
    public function destroy($id)
    {
        // Delete the subject from the database
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }


}
