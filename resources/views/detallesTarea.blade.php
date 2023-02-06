@section('titulo', 'Ver Tareas')

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
</style>

@section('contenido')

    <div id="cuerpo">

        <h3 id="centrar">Detalles Tarea {{ $tarea->id }}</h3>

        <table class="table table-bordered table-striped">
            <tr>
                <th class="col-md-2">ID</th>
                <td class="col-md-4">{{ $tarea->id }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Cliente</th>
                <td class="col-md-4">
                    @if ($tarea->cliente)
                        {{ $tarea->cliente->cif }}
                    @else
                        Cliente dado de baja
                    @endif
                </td>
            </tr>
            <tr>
                <th class="col-md-2">Nombre y Apellidos</th>
                <td class="col-md-4">{{ $tarea->nombre_y_apellidos }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Télefono</th>
                <td class="col-md-4">{{ $tarea->telefono }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Correo electrónico</th>
                <td class="col-md-4">{{ $tarea->correo }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Descripción</th>
                <td class="col-md-4">{{ $tarea->descripcion }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Dirección</th>
                <td class="col-md-4">{{ $tarea->direccion }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Población</th>
                <td class="col-md-4">{{ $tarea->poblacion }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Código postal</th>
                <td class="col-md-4">{{ $tarea->codigo_postal }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Provincia</th>
                <td class="col-md-4">{{ $tarea->provincia->nombre }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Estado de la tarea</th>
                <td class="col-md-4">
                    @switch($tarea->estado)
                        @case('P')
                            Pendiente
                        @break

                        @case('R')
                            Realizada
                        @break

                        @case('C')
                            Cancelada
                        @break

                        @default
                            {{ $tarea->estado }}
                    @endswitch
                </td>
            </tr>
            <tr>
                <th class="col-md-2">Operario encargado</th>
                <td class="col-md-4">
                    @if ($tarea->empleado)
                        {{ $tarea->empleado->nif }}
                    @else
                        Empleado dado de baja
                    @endif
                </td>
            </tr>
            <tr>
                <th class="col-md-2">Fecha de creación</th>
                <td class="col-md-4">{{ date('d-m-Y', strtotime($tarea->fecha_creacion)) }}</td>
            </tr>
            <th class="col-md-2">Fecha de realización</th>
            <td class="col-md-4">{{ date('d-m-Y', strtotime($tarea->fecha_realizacion)) }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Anotaciones anteriores</th>
                <td class="col-md-4">{{ $tarea->anotaciones_anteriores }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Anotaciones posteriores</th>
                <td class="col-md-4">{{ $tarea->anotaciones_posteriores }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Fichero</th>
                <td class="col-md-4">
                    @if ($tarea->fichero_resumen)
                        <a class="btn btn-info" href="{{ Storage::url('public/files/' . $tarea->fichero_resumen) }}"
                            download="{{ basename($tarea->fichero_resumen) }}">Descargar</a>
                    @endif
                </td>
            </tr>
        </table>

    </div>

    <div id="centrar"><a class="btn btn-success" href="{{ route('listaTareas') }}"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg> Volver
            atras</a>
    </div>


@endsection
