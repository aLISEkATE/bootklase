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

    @foreach ($students as $student)
        <p><strong>{{ $student->first_name }} {{ $student->last_name }}</strong></p>
        <img src="{{ $student->avatar ? asset('storage/' . $student->avatar) : asset('default-avatar.png') }}" alt="Student Avatar" width="100">
        <form action="/students/{{ $student->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this student?')">Delete</button>
        </form>
        <a href="/students/{{ $student->id }}/edit" style="display:inline;">Edit</a>
    @endforeach

<!--<img src="{{ $student->avatar ? asset('storage/' . $student->avatar) : asset('default-avatar.png') }}" alt="User Avatar" width="100">-->
</body>
</html>