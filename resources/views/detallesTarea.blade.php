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
                <td class="col-md-4">{{ $tarea->cliente }}</td>
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
                <th class="col-md-2">Población</th>
                <td class="col-md-4">{{ $tarea->poblacion }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Código postal</th>
                <td class="col-md-4">{{ $tarea->codigo_postal }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Provincia</th>
                <td class="col-md-4">{{ $tarea->provincia }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Estado de la tarea</th>
                <td class="col-md-4">{{ $tarea->estado }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Operario encargado</th>
                <td class="col-md-4">{{ $tarea->operario_encargado }}</td>
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
                <td class="col-md-4">{{ $tarea->fichero }}</td>
            </tr>
        </table>

    </div>

    <div id="centrar"><a class="btn btn-success" href="{{ route('listaTareas') }}">Volver
            atras</a>
    </div>


@endsection
