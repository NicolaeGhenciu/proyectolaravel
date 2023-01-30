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
                            <td>{{ $cliente->importe_cuota_mensual }}</td>
                            <td>{{ $cliente->pais->iso3 }}</td>
                            <td>{{ $cliente->moneda }}</td>
                            <td>{{-- <a class="btn btn-warning" href="#" title="Modificar"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>&nbsp; --}}<a class="btn btn-danger"
                                    href="{{ route('mensajeBorrarCliente', $cliente) }}" title="Borrar"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a></td>
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
