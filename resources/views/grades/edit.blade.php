<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Document</title>
</head>
<body>
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

    <h1>Edit Grade</h1>

    <form action="/grades/{{ $grade->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" value="{{ $grade->student_id }}" required><br><br>

        <label for="subject_id">Subject ID:</label>
        <input type="text" id="subject_id" name="subject_id" value="{{ $grade->subject_id }}" required><br><br>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" value="{{ $grade->grade }}" required><br><br>

        <input type="submit" value="Update">
    </form>

</body>
</html>