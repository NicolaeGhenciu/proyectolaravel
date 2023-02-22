@section('titulo', 'Lista de Tareas')

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

        <h3 id="centrar">Lista de tareas</h3>

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
                        <th scope="col">Cliente</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Operario Encargado</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->id }}</td>
                            <td>
                                @if ($tarea->cliente)
                                    {{ $tarea->cliente->cif }}
                                @else
                                    Cliente no encontrado
                                @endif
                            </td>
                            <td>{{ $tarea->nombre_y_apellidos }}</td>
                            <td>{{ $tarea->provincia->nombre }}</td>
                            <td>
                                @if ($tarea->empleado)
                                    {{ $tarea->empleado->nif }}
                                @else
                                    Empleado no asignado
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($tarea->fecha_creacion)) }}</td>
                            <td>
                                @if ($tarea->estado == 'R')
                                    ✅
                                @elseif($tarea->estado == 'P')
                                    ◻️
                                @else
                                    ❌
                                @endif
                            </td>
                            <td>
                                @if (Auth::check() && Auth::user()->es_admin === 0)
                                    <a class="btn btn-info" href="{{ route('detallesTareaOperario', $tarea) }}"
                                        title="Ver detalles"><i class="bi bi-eye"></i></a>&nbsp;
                                    <a class="btn btn-success" href="{{ route('formCompletarTarea', $tarea) }}"
                                        title="Completar Tarea"><i class="bi bi-journal-check"></i></a>&nbsp;
                                @endif
                                @if (Auth::check() && Auth::user()->es_admin === 1)
                                    <a class="btn btn-info" href="{{ route('detallesTarea', $tarea) }}"
                                        title="Ver detalles"><i class="bi bi-eye"></i></a>&nbsp;
                                    <a class="btn btn-warning" href="{{ route('forModTarea', $tarea) }}"
                                        title="Modificar"><i class="bi bi-pencil-square"></i></a>&nbsp;
                                    <a class="btn btn-danger" href="{{ route('mensajeBorrarTarea', $tarea) }}"
                                        title="Borrar"><i class="bi bi-trash-fill"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $tareas->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tareas->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item {{ $tareas->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tareas->url(1) }}">Primera</a>
                    </li>
                    @for ($i = 1; $i <= $tareas->lastPage(); $i++)
                        <li class="page-item {{ $tareas->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $tareas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $tareas->currentPage() == $tareas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tareas->url($tareas->lastPage()) }}">Última</a>
                    </li>
                    <li class="page-item {{ $tareas->currentPage() == $tareas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $tareas->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


@endsection
