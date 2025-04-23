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

    <p>HIiiiiii :3</p>

    @guest

<a href="/login">Login</a>

<p>Welcome to bootklase, Guest!</p>

@endguest

@auth

<form action= "/logout" method="POST">

  @csrf
 
<button type="submit">Logout</button>

</form>

<p>Welcome to bootklase, {{ Auth::user()->first_name}}!</p>

@endauth


    
</body>
</html>