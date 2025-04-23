<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Register</title>

</head>
<body>
  
<h1>Register</h1>

<form action="/register" method="POST">
    @csrf

    @if ($errors->any())
     <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
     </ul>
    @endif  

    <label>First Name:</label>
    <input type="text" name="first_name" required>
    <br>

    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    <br>

    <label>Email:</label>
    <input type="email" name="email" required>
    <br>

    <label>Role:</label>
         <select name="role" required> 
             <option value="student">Student</option>
             <option value="teacher">Teacher</option>
          </select>
    <br>

    <label>Password:</label>
    <input type="password" name="password" required>
    <br>

    <label>Password:</label>
    <input type="password" name="password_confirmation" required>
    <br>
    
    <button type="submit">Register</button>  
</form>
</body>
</html>