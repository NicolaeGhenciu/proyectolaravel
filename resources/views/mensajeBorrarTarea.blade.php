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
    <br>
    <div id="centrar">
        <h2>¿Estas seguro de querer borrar la tarea {{ request('id') }}?</h2>
    </div>

    <div id="cuerpo">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Télefono</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Población</th>
                        <th scope="col">Codigo postal</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Operario Encargado</th>
                        <th scope="col">Fecha de realización</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $tarea->cliente }}</td>
                        <td>{{ $tarea->nombre_y_apellidos }}</td>
                        <td>{{ $tarea->telefono }}</td>
                        <td>{{ $tarea->descripcion }}</td>
                        <td>{{ $tarea->direccion }}</td>
                        <td>{{ $tarea->poblacion }}</td>
                        <td>{{ $tarea->codigo_postal }}</td>
                        <td>{{ $tarea->provincia }}</td>
                        <td>{{ $tarea->operario_encargado }}</td>
                        <td>{{ date('d-m-Y', strtotime($tarea->fecha_realizacion)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <form action="{{ route('tareas.destroy', $tarea) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
                <a class="btn btn-success" href="{{ route('tareas.index') }}">Volver atrás</a>
            </form>
        </div>

        <div id="centrar">
            <a class="btn btn-danger"
                href="{{ route('borrarTarea', ['id' => $tarea->id]) }}">Borrar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                class="btn btn-success" href="{{ route('listaTareas') }}">Volver
                atras</a>
        </div>


    @endsection
