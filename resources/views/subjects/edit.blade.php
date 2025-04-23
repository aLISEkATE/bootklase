<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

    <h1>Edit Subject</h1>

    <form action="/subjects/{{ $subject->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Subject Name:</label>
        <input type="text" id="name" name="subject_name" value="{{ $subject->subject_name }}" required><br><br>

        <input type="submit" value="Update Subject">
    </form>
</body>
</html>