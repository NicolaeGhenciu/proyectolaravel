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
        <h2>¿Estas seguro de querer borrar el cliente  {{ $cliente->id }}?</h2>
    </div>

    <div id="cuerpo">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">CIF</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Télefono</th>
                        <th scope="col">Correo electronico</th>
                        <th scope="col">Cuenta Corriente</th>
                        <th scope="col">Cuota Mensual</th>
                        <th scope="col">Pais</th>
                        <th scope="col">Moneda</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->cif }}</td>
                        <td>{{ $cliente->nombre_y_apellidos }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->cuenta_corriente }}</td>
                        <td>{{ $cliente->importe_cuota_mensual }}</td>
                        <td>{{ $cliente->pais_id }}</td>
                        <td>{{ $cliente->moneda }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <form action="{{ route('borrarCliente', $cliente) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
                <a class="btn btn-success" href="{{ route('listaClientes') }}">Volver atras</a>
            </form>
        </div>

    @endsection
