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

    <h1>Add Student</h1>

    <form action="/students" method="POST">
        @csrf
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <input type="submit" value="Add Student">
    </form>
</body>
</html>