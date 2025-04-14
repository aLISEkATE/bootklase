<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div>
        <!--navbar-->
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/students/create">Add Student</a></li>
                <li><a href="/subjects/create">Add Subject</a></li>
                <li><a href="/grades/create">Add grade</a></li>
                <li><a href="/grades">View</a></li>
            </ul>
        </nav>
    </div>

    <h1>Grades List</h1>

    @foreach ($grades as $grade)
        <p>Student ID: {{ $grade->student_id }}</p>
        <p>Subject ID: {{ $grade->subject_id }}</p>
        <p>Grade: {{ $grade->grade }}</p>
        <form action="/grades/{{ $grade->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <hr>
    @endforeach
</body>
</html>