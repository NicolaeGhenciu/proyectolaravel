@section('titulo', 'Lista de Empleados')

@extends('base')

<style>
    #centrar {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #cuerpo {
        margin: 2em;
    }

    tr,
    td,
    th {
        text-align: center;
    }
</style>

@section('contenido')

    <div id="cuerpo">

        <h3 id="centrar">Lista de empleados</h3>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">NIF</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Fecha de alta</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Télefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nif }}</td>
                            <td>{{ $empleado->nombre_y_apellidos }}</td>
                            <td>{{ date('d-m-Y', strtotime($empleado->fecha_alta)) }}</td>
                            <td>{{ $empleado->email }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->direccion }}</td>
                            <td>{{ $empleado->es_admin == 0 ? '👨🏻‍🔧 Operario' : '👨🏻‍💼 Administrador' }}</td>
                            <td><a class="btn btn-warning" href="{{ route('forModEmpleado', $empleado) }}"
                                    title="Modificar"><i class="bi bi-pencil-square"></i></a>&nbsp;
                                <a class="btn btn-danger" href="{{ route('mensajeBorrarEmpleado', $empleado) }}"
                                    title="Borrar"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $empleados->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $empleados->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item {{ $empleados->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $empleados->url(1) }}">Primera</a>
                    </li>
                    @for ($i = 1; $i <= $empleados->lastPage(); $i++)
                        <li class="page-item {{ $empleados->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $empleados->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $empleados->currentPage() == $empleados->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $empleados->url(5) }}">Última</a>
                    </li>
                    <li class="page-item {{ $empleados->currentPage() == $empleados->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $empleados->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


@endsection
