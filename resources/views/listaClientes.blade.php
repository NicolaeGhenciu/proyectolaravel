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

        <h3 id="centrar">Lista de clientes</h3>

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
                        <th scope="col">CIF</th>
                        <th scope="col">Nombre y Apellidos</th>
                        <th scope="col">Télefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Cuenta Corriente</th>
                        <th scope="col">Importe Mensual</th>
                        <th scope="col">País</th>
                        <th scope="col">Moneda</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->cif }}</td>
                            <td>{{ $cliente->nombre_y_apellidos }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->correo }}</td>
                            <td>{{ $cliente->cuenta_corriente }}</td>
                            <td>{{ $cliente->cuota_mensual }}</td>
                            <td>{{ $cliente->pais->iso3 }}</td>
                            <td>{{ $cliente->moneda }}</td>
                            <td><a class="btn btn-danger" href="{{ route('mensajeBorrarCliente', $cliente) }}"
                                    title="Borrar"><i class="bi bi-trash-fill"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $clientes->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $clientes->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item {{ $clientes->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $clientes->url(1) }}">Primera</a>
                    </li>
                    @for ($i = 1; $i <= $clientes->lastPage(); $i++)
                        <li class="page-item {{ $clientes->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $clientes->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $clientes->currentPage() == $clientes->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $clientes->url(5) }}">Última</a>
                    </li>
                    <li class="page-item {{ $clientes->currentPage() == $clientes->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $clientes->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


@endsection
