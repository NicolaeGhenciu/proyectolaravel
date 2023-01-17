<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>@yield('titulo')</title>
    <style>
        .nav-link.active {
            font-size: 20px;
        }
    </style>
</head>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="nav navbar-nav">
        <a class="nav-link {{ request()->routeIs('formRegEmpleado') ? 'active' : '' }}"
            href="{{ route('formRegEmpleado') }}">Insertar Empleado</a>
        <a class="nav-link {{ request()->routeIs('formRegCliente') ? 'active' : '' }}"
            href="{{ route('formRegCliente') }}">Insertar Cliente</a>
        <a class="nav-link {{ request()->routeIs('formTarea') ? 'active' : '' }}"
            href="{{ route('formTarea') }}">Insertar Tareas</a>
        <a class="nav-link {{ request()->routeIs('formMantenimientoCliente') ? 'active' : '' }}"
            href="{{ route('formMantenimientoCliente') }}">Insertar Cuota</a>
    </div>
</nav>

<body>
    @yield('contenido')
</body>

</html>
