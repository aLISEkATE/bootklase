<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Subject</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grades as $grade)
            <tr>
                <td>{{ $grade->student->first_name }}</td>
                <td>{{ $grade->student->last_name }}</td>
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->grade }}</td>
                @if (auth()->user()->role === 'teacher')
                <td>
    1            <form action="/grades/{{ $grade->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this grade?')">Delete</button>
                 </form>
</td>
@endif
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>