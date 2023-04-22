@section('titulo', 'Lista de Clientes')

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

        <h3 id="centrar">Lista de Monedas</h3>

        <table>
            <thead>
                <tr>
                    <th>Moneda</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Valor respecto al euro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monedas as $moneda => $valor)
                    <tr>
                        <td>{{ $moneda }}</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>{{ $valor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>


@endsection
