<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title> FACTURA {{ $cuota->id }}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center"><img src="{{ asset('img/logo-hd.png') }}" width="50px" height="50px">
                </h1>
                <h3 class="text-center">SIEMPRECOLGADOS S.A</h3>
                <p class="text-center">Av. Madrid nº4</p>
                <h5 class="text-center">Factura</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group list-group-item">
                            <label><b>ID Cuota:</b> {{ $cuota->id }}</label>
                        </div>
                        <div class="form-group list-group-item">
                            <label><b>CIF cliente:</b> {{ $cuota->cliente->cif }}</label>
                        </div>
                        <div class="form-group list-group-item">
                            <label><b>Concepto:</b> {{ $cuota->concepto }}</label>
                        </div>
                        <div class="form-group list-group-item">
                            <label><b>Fecha Emisión:</b> {{ date('d-m-Y', strtotime($cuota->fecha_emision)) }}</label>
                        </div>
                        <div class="form-group list-group-item">
                            <label>Importe: <b>{{ $cuota->importe }} €</b></label>
                        </div>
                        {{-- <div class="form-group list-group-item">
                            <label class="font-weight-bold">Pagada:</label>
                            <p class="mb-0">{{ $cuota->pagada }}</p>
                        </div> --}}
                        @if ($cuota->pagada == 'SI')
                            <div class="form-group list-group-item">
                                <label class="font-weight-bold">Fecha Pago:</label>
                                <p class="mb-0">{{ date('d-m-Y', strtotime($cuota->fecha_pago)) }}</p>
                            </div>
                        @endif
                        <div class="form-group list-group-item">
                            <label class="font-weight-bold">Notas:</label>
                            <p class="mb-0">{{ $cuota->notas }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
