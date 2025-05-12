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
    <h1>Subjects</h1>

    @foreach ($subjects as $subject)
        <p><strong>{{ $subject->subject_name }}<strong></p>
               <form action="/subjects/{{ $subject->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this grade?')">Delete</button>
                 </form>
                 <a href="/subjects/{{ $subject->id }}/edit"  style="display:inline;">Edit</a>
    @endforeach
    
</body>
</html>