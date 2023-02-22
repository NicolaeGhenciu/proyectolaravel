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
                            <td>{{ $cuota->importe }} {{ $cuota->cliente->moneda }}</td>
                            <td>{{ $cuota->pagada == 'SI' ? '✅' : '❌' }}</td>
                            <td>
                                @if ($cuota->fecha_pago)
                                    {{ date('d-m-Y', strtotime($cuota->fecha_pago)) }}
                                @endif
                            </td>
                            <td>{{ $cuota->notas }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('forModCuota', $cuota) }}" title="Modificar"><i
                                        class="bi bi-pencil-square"></i></a>&nbsp;
                                <a class="btn btn-danger" href="{{ route('mensajeBorrarCuota', $cuota) }}"
                                    title="Borrar"><i class="bi bi-trash-fill"></i></a>
                                <a class="btn btn-success" title="Descargar Factura PDF"
                                    href="{{ route('generatePDF', $cuota) }}"><i class="bi bi-filetype-pdf"></i></a>
                                <a class="btn btn-info" title="Enviar Factura al Cliente"
                                    href="{{ route('enviarCuotaCorreo', ['cuota' => $cuota]) }}"><i
                                        class="bi bi-envelope-fill"></i></a>
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
                        <a class="page-link" href="{{ $cuotas->url($cuotas->lastPage()) }}">Última</a>
                    </li>
                    <li class="page-item {{ $cuotas->currentPage() == $cuotas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $cuotas->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


@endsection
