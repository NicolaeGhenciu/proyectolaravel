<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    @yield('linkScript')

    <title>@yield('titulo')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Signika Negative', sans-serif;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('siemprecolgados') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;🏗️
        SIEMPRECOLGADOS S.A</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                @if (Auth::check() && Auth::user()->es_admin === 1)
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Insertar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ request()->routeIs('formTarea') ? 'active' : '' }}"
                            href="{{ route('formTarea') }}">Tarea</a>
                        <a class="dropdown-item {{ request()->routeIs('formRegEmpleado') ? 'active' : '' }}"
                            href="{{ route('formRegEmpleado') }}">Empleado</a>
                        <a class="dropdown-item {{ request()->routeIs('formRegCliente') ? 'active' : '' }}"
                            href="{{ route('formRegCliente') }}">Cliente</a>
                        <a class="dropdown-item {{ request()->routeIs('formularioCuota') ? 'active' : '' }}"
                            href="{{ route('formularioCuota') }}">Cuota excepcional</a>
                        <a class="dropdown-item {{ request()->routeIs('formRemesaMensual') ? 'active' : '' }}"
                            href="{{ route('formRemesaMensual') }}">Remesa mensual</a>
                    </div>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Listar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::check() && Auth::user()->es_admin === 0)
                        <a class="dropdown-item {{ request()->routeIs('listaTareasOperario') ? 'active' : '' }}"
                            href="{{ route('listaTareasOperario') }}">Tareas</a>
                    @endif
                    @if (Auth::check() && Auth::user()->es_admin === 1)
                        <a class="dropdown-item {{ request()->routeIs('listaTareas') ? 'active' : '' }}"
                            href="{{ route('listaTareas') }}">Tareas</a>
                        <a class="dropdown-item {{ request()->routeIs('listaEmpleados') ? 'active' : '' }}"
                            href="{{ route('listaEmpleados') }}">Empleados</a>
                        <a class="dropdown-item {{ request()->routeIs('listaClientes') ? 'active' : '' }}"
                            href="{{ route('listaClientes') }}">Clientes</a>
                        <a class="dropdown-item {{ request()->routeIs('listaClientesRusos') ? 'active' : '' }}"
                            href="{{ route('listaClientesRusos') }}">Clientes Rusos</a>

                        <a class="dropdown-item {{ request()->routeIs('tiposCambio') ? 'active' : '' }}"
                            href="{{ route('tiposCambio') }}">Tipos Cambio</a>

                        <a class="dropdown-item {{ request()->routeIs('listaCuotas') ? 'active' : '' }}"
                            href="{{ route('listaCuotas', 'fecha_emision') }}">Cuotas</a>
                    @endif
                </div>
            </li>
            {{-- <li class="nav-item dropdown">
                <a class="nav-link {{ request()->routeIs('miCuenta') ? 'active' : '' }}"
                    href="{{ route('miCuenta', Auth::user()) }}" id="navbarDropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="d-flex align-items-center">
        <a class="nav-link" href="{{ route('miCuenta', Auth::user()) }}" id="navbarDropdown" role="button"
            aria-haspopup="true" aria-expanded="false">
            <span class="text-white px-4">{{ Auth::user()->nombre_y_apellidos }} |
                {{ Auth::user()->es_admin == 0 ? '👨🏻‍🔧 Operario' : '👨🏻‍💼 Administrador' }}</span>
        </a>
        @if (Auth::check())
            <a class="btn btn-outline-danger ml-auto" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-door-open-fill"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</nav>

<body>
    @yield('contenido')
</body>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>
        <span class="mb-3 mb-md-0 text-muted"> 🏗️ © 2023 SIEMPRECOLGADOS, S.A</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="https://github.com/NicolaeGhenciu"><i
                    class="bi bi-meta"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="https://github.com/NicolaeGhenciu"><i
                    class="bi bi-github"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="https://github.com/NicolaeGhenciu"><i
                    class="bi bi-android2"></i></a></li>
        <li class="ms-3"><a class="text-muted" href="#"></a></li>
        <li class="ms-3"><a class="text-muted" href="#"></a></li>
    </ul>
</footer>

</html>
