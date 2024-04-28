<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">

    <title>Tanyain</title>
</head>
<body>
    <h1>Halaman about</h1>
    <h3> {{ $name }}</h3>
    <h3>{{ $email }}</h3>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200">
    @foreach ($subject as $item)
        <h1>{{ $item->name }}</h1>
    @endforeach
</body>
</html>

