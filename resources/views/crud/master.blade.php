<!DOCTYPE html>
<html>
<head>
    <title>CRUD MexiGo</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('hotel.index') }}">Hoteles</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('hotel.index') }}">Ver todos los hoteles</a></li>
        <li><a href="{{ route('hotel.create') }}">Crear nuevo hotel</a>
    </ul>
</nav>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>


</body>
</html>
