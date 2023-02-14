<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>

<body>
    <h1>Factura</h1>
    <p>ID: {{ $cuota->id }}</p>
    <p>Cliente: {{ $cuota->cliente->cif }}</p>
    <p>Concepto: {{ $cuota->concepto }}</p>
    <p>Fecha Emisión: {{ date('d-m-Y', strtotime($cuota->fechaEmision)) }}</p>
    <p>Importe: {{ $cuota->importe }}€</p>
    <p>Pagada: {{ $cuota->pagada }}</p>
    <p>Fecha Pago: {{ date('d-m-Y', strtotime($cuota->fechaPago)) }}</p>
    <p>Notas: {{ $cuota->notas }}</p>
</body>

</html>
