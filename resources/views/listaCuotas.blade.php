@section('titulo', 'Lista de Cuotas')

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

    <br>

    <div class="d-flex flex-column align-items-center w-50 mx-auto">
        <h4 class="text-center">Filtar por:</h4>
        <div class="d-flex justify-content-center">
            <a class="btn btn-outline-dark" href="{{ route('listaCuotas', ['fecha_emision']) }}">Fecha de emisión</a>&nbsp;
            <a class="btn btn-outline-dark" href="{{ route('listaCuotas', ['fecha_pago']) }}">Fecha de pago</a>&nbsp;
            <a class="btn btn-outline-dark" href="{{ route('listaCuotas', ['SI']) }}">Pagadas</a>&nbsp;
            <a class="btn btn-outline-dark" href="{{ route('listaCuotas', ['NO']) }}">NO pagadas</a>&nbsp;
        </div>
    </div>

    <div id="cuerpo">

        <h3 id="centrar">Lista de cuotas</h3>

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
                        <th scope="col">Cliente</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Fecha de emisión</th>
                        <th scope="col">Importe</th>
                        <th scope="col">Pagada</th>
                        <th scope="col">Fecha de pago</th>
                        <th scope="col">Notas</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuotas as $cuota)
                        <tr>
                            <td>{{ $cuota->id }}</td>
                            <td>
                                @if ($cuota->cliente)
                                    {{ $cuota->cliente->cif }}
                                @else
                                    Cliente dado de baja
                                @endif
                            </td>
                            <td>{{ $cuota->concepto }}</td>
                            <td>
                                @if ($cuota->fecha_emision)
                                    {{ date('d-m-Y', strtotime($cuota->fecha_emision)) }}
                                @endif
                            </td>
                            <td>{{ $cuota->importe }} €</td>
                            <td>{{ $cuota->pagada == 'SI' ? '✅' : '❌' }}</td>
                            <td>
                                @if ($cuota->fecha_pago)
                                    {{ date('d-m-Y', strtotime($cuota->fecha_pago)) }}
                                @endif
                            </td>
                            <td>{{ $cuota->notas }}</td>
                            <td><a class="btn btn-warning" href="{{ route('forModCuota', $cuota) }}" title="Modificar"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>&nbsp;<a class="btn btn-danger"
                                    href="{{ route('mensajeBorrarCuota', $cuota) }}" title="Borrar"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a>
                                <a class="btn btn-success" href="{{ route('generatePDF', $cuota) }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                    </svg></a>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="centrar">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $cuotas->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $cuotas->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item {{ $cuotas->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $cuotas->url(1) }}">Primera</a>
                    </li>
                    @for ($i = 1; $i <= $cuotas->lastPage(); $i++)
                        <li class="page-item {{ $cuotas->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $cuotas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $cuotas->currentPage() == $cuotas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $cuotas->url(5) }}">Última</a>
                    </li>
                    <li class="page-item {{ $cuotas->currentPage() == $cuotas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $cuotas->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


@endsection
