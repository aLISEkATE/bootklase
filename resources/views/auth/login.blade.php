<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>

<form action="" method="POST">
@csrf
    <label>Email: </label> <input name="email" type="email" placeholder="example@email.com" value="{{ old('email') }}"> 
    <label>Password: </label> <input name="password"  type="password" placeholder="Enter a strong password"> 

    <button type="submit">Login</button>
</form>

@if ($errors->any())
     <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
     </ul>
@endif

</body>
</html>
