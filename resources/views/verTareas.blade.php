@section('titulo', 'Ver Tareas')

@extends('base')

@section('contenido')

    <div class="pagination">
        {{ $tareas->links() }}
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Operario encargado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->nombre_y_apellidos }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ $tarea->operario_encargado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
