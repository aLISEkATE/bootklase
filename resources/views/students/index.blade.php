<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($students as $student)
        <p><strong>{{ $student->first_name }} {{ $student->last_name }}</strong></p>

    @endforeach
</body>
</html>