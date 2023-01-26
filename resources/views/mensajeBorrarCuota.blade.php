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
        <h2>¿Estas seguro de querer borrar la cuota {{ request('id') }}?</h2>
    </div>

    <div id="cuerpo">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Fecha de emisión</th>
                        <th scope="col">Importe</th>
                        <th scope="col">Pagada</th>
                        <th scope="col">Fecha de pago</th>
                        <th scope="col">Notas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $cuota->id }}</td>
                        <td>{{ $cuota->clientes_id }}</td>
                        <td>{{ $cuota->concepto }}</td>
                        <td>{{ date('d-m-Y', strtotime($cuota->fecha_emision)) }}</td>
                        <td>{{ $cuota->importe }}</td>
                        <td>{{ $cuota->pagada }}</td>
                        <td>{{ date('d-m-Y', strtotime($cuota->fecha_pago)) }}</td>
                        <td>{{ $cuota->notas }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <form action="{{ route('borrarCuota', $cuota) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Borrar</button>
                <a class="btn btn-success" href="{{ route('listaEmpleados') }}">Volver atras</a>
            </form>
        </div>

    @endsection
