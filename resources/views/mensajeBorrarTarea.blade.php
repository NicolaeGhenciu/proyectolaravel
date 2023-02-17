@section('titulo', 'Borrar')

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
        <h2>¿Estas seguro de querer borrar la tarea {{ $tarea->id }}?</h2>
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
                        <td>{{ $tarea->cliente->cif }}</td>
                        <td>{{ $tarea->nombre_y_apellidos }}</td>
                        <td>{{ $tarea->telefono }}</td>
                        <td>{{ $tarea->descripcion }}</td>
                        <td>{{ $tarea->direccion }}</td>
                        <td>{{ $tarea->poblacion }}</td>
                        <td>{{ $tarea->codigo_postal }}</td>
                        <td>{{ $tarea->provincia->nombre }}</td>
                        <td>{{ $tarea->empleado->nif }}</td>
                        <td>{{ date('d-m-Y', strtotime($tarea->fecha_realizacion)) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <form action="{{ route('borrarTarea', $tarea) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-success" href="{{ route('listaTareas') }}"><i class="bi bi-arrow-left"></i> Volver
                    atras</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Borrar</button>
            </form>
        </div>

    @endsection
