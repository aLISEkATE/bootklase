<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @auth
<nav>
    <ul>
        <li><a href="/">Home</a></li>

        @if (auth()->user()->role === 'teacher')
            <li><a href="/students/create">Add Student</a></li>
            <li><a href="/subjects/create">Add Subject</a></li>
            <li><a href="/grades/create">Add grade</a></li>
        @endif

        <li><a href="/grades">View</a></li>
    </ul>
</nav>
@endauth
</head>
<body>

<h1>Create Grade</h1>


<form action="/grades" method="POST">
    @csrf

    <!-- Student Dropdown -->
    <label for="student_id">Student:</label>
    <select id="student_id" name="student_id" required>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
        @endforeach
    </select>
    <br><br>

    <!-- Subject Dropdown -->
    <label for="subject_id">Subject:</label>
    <select id="subject_id" name="subject_id" required>
        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
        @endforeach
    </select>
    <br><br>

    <!-- Grade Input -->
    <label for="grade">Grade:</label>
    <input type="text" id="grade" name="grade" required>
    <br><br>

    <input type="submit" value="Submit">
</form>
    
</body>
</html>


