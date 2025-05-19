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

   

    </div>

    <p>HIiiiiii :3</p>

    @guest

<a href="/login">Login</a>
<a href="/register">Register</a>
<p>Welcome to bootklase, Guest!</p>

@endguest

@auth

<h3>Sveiki, {{ Auth::user()->first_name}}</h3>
<form action= "/logout" method="POST">

        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar" accept="image/*"><br><br>

  @csrf
 
<button type="submit">Logout</button>

</form>

<p>Hello, {{ Auth::user()->first_name}}!</p>

<form action="{{ route('students.updateAvatar', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <label for="avatar">Avatar:</label>
    <input type="file" name="avatar" id="avatar" accept="image/*"><br><br>

    <button type="submit">Update Avatar</button>
</form>

@endauth


    
</body>
</html>