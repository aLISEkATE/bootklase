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
    <h1>Add Student</h1>

    <form action="/students" method="POST">
        @csrf
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>


        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

        <input type="submit" value="Add Student">
    </form>
</body>
</html>