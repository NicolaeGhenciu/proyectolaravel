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
        <h2>¿Estas seguro de querer borrar el empleado {{ $empleado->id }}?</h2>
    </div>

    <div id="cuerpo">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">NIF</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Fecha de alta</th>
                        <th scope="col">Correo electronico</th>
                        <th scope="col">Télefono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nif }}</td>
                        <td>{{ $empleado->nombre_y_apellidos }}</td>
                        <td>{{ date('d-m-Y', strtotime($empleado->fecha_alta)) }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->direccion }}</td>
                        <td>{{ $empleado->es_admin == 0 ? '👨🏻‍🔧 Operario' : '👨🏻‍💼 Administrador' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <form action="{{ route('borrarEmpleado', $empleado) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-success" href="{{ route('listaEmpleados') }}"><i class="bi bi-arrow-left"></i> Volver
                    atras</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Borrar</button>
            </form>
        </div>

    @endsection
