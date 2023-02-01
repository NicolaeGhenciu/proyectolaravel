<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
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
    <a class="navbar-brand" href="{{ route('siemprecolgados') }}">&nbsp;🏗️ SIEMPRECOLGADOS S.A</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Listar
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ request()->routeIs('listaTareas') ? 'active' : '' }}"
                        href="{{ route('listaTareas') }}">Tareas</a>
                    <a class="dropdown-item {{ request()->routeIs('listaEmpleados') ? 'active' : '' }}"
                        href="{{ route('listaEmpleados') }}">Empleados</a>
                    <a class="dropdown-item {{ request()->routeIs('listaClientes') ? 'active' : '' }}"
                        href="{{ route('listaClientes') }}">Clientes</a>
                    <a class="dropdown-item {{ request()->routeIs('listaCuotas') ? 'active' : '' }}"
                        href="{{ route('listaCuotas', 'fecha_emision') }}">Cuotas</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

{{-- <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="nav navbar-nav">
        <b><a class="nav-link active" href="#">🏗️ SIEMPRECOLGADOS S.A</a></b>
        <a class="nav-link {{ request()->routeIs('formRegEmpleado') ? 'active' : '' }}"
            href="{{ route('formRegEmpleado') }}">Insertar Empleado</a>
        <a class="nav-link {{ request()->routeIs('formRegCliente') ? 'active' : '' }}"
            href="{{ route('formRegCliente') }}">Insertar Cliente</a>
        <a class="nav-link {{ request()->routeIs('formCuota') ? 'active' : '' }}"
            href="{{ route('formCuota') }}">Insertar Cuota</a>
        <a class="nav-link {{ request()->routeIs('formTarea') ? 'active' : '' }}"
            href="{{ route('formTarea') }}">Insertar Tareas</a>
        <a class="nav-link {{ request()->routeIs('listaTareas') ? 'active' : '' }}"
            href="{{ route('listaTareas') }}">Lista de Tareas</a>
        <a class="nav-link {{ request()->routeIs('listaEmpleados') ? 'active' : '' }}"
            href="{{ route('listaEmpleados') }}">Lista de Empleados</a>
        <a class="nav-link {{ request()->routeIs('listaClientes') ? 'active' : '' }}"
            href="{{ route('listaClientes') }}">Lista de Clientes</a>
        <a class="nav-link {{ request()->routeIs('listaCuotas') ? 'active' : '' }}"
            href="{{ route('listaCuotas') }}">Lista de Cuotas</a>
    </div>
</nav> --}}

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
        <li class="ms-3"><a class="text-muted" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                </svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
                    <path
                        d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z" />
                </svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                    <path
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                </svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"></a></li>
    </ul>
</footer>

</html>
