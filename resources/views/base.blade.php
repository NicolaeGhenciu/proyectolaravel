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
        <b><a class="nav-link active" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                    <path
                        d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z" />
                </svg> SIEMPRECOLGADOS S.A</a></b>
        <a class="nav-link {{ request()->routeIs('formRegEmpleado') ? 'active' : '' }}"
            href="{{ route('formRegEmpleado') }}">Insertar Empleado</a>
        <a class="nav-link {{ request()->routeIs('formRegCliente') ? 'active' : '' }}"
            href="{{ route('formRegCliente') }}">Insertar Cliente</a>
        <a class="nav-link {{ request()->routeIs('formTarea') ? 'active' : '' }}"
            href="{{ route('formTarea') }}">Insertar Tareas</a>
        <a class="nav-link {{ request()->routeIs('formMantenimientoCliente') ? 'active' : '' }}"
            href="{{ route('formMantenimientoCliente') }}">Insertar Cuota</a>
        <a class="nav-link {{ request()->routeIs('listaTareas') ? 'active' : '' }}"
            href="{{ route('listaTareas') }}">Lista
            de Tareas</a>
    </div>
</nav>

<body>
    @yield('contenido')
</body>

</html>
