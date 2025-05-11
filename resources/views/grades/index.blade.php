<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

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

    <form method="GET" action="{{ route('grades.index') }}">
    <select name="student_id">
        <option value="">All Students</option>
        @foreach($students as $student)
            <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                {{ $student->first_name }} {{ $student->last_name }}
            </option>
        @endforeach
    </select>

    <select name="subject_id">
        <option value="">All Subjects</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                {{ $subject->subject_name }}
            </option>
        @endforeach
    </select>

    <select name="sort_order">
     <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
     <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
    </select>


    <button type="submit">Filter</button>
    </form>
        @foreach ($grades as $grade)
            <tr>
                <td>{{ $grade->student->first_name }}</td>
                <td>{{ $grade->student->last_name }}</td>
                <td>{{ $grade->subject->subject_name }}</td>
                <td>{{ $grade->grade }}</td>
                @if (auth()->user()->role === 'teacher')
                <td>
              <form action="/grades/{{ $grade->id }}" method="POST" style="display:inline;">
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