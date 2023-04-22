<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Listado de clientes rusos</title>
</head>
<body>
    <h3>LISTA DE CLIENTES RUSOS</h3>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    {{-- <th scope="col">Id</th> --}}
                    <th scope="col">CIF</th>
                    <th scope="col">Nombre y Apellidos</th>
                    <th scope="col">Télefono</th>
                    {{-- <th scope="col">Correo</th>
                    <th scope="col">Cuenta Corriente</th>
                    <th scope="col">Importe Mensual</th>
                    <th scope="col">País</th>
                    <th scope="col">Moneda</th> --}}
                    <th>Importe Total</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        {{-- <td>{{ $cliente->id }}</td> --}}
                        <td>{{ $cliente->cif }}</td>
                        <td>{{ $cliente->nombre_y_apellidos }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        {{-- <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->cuenta_corriente }}</td>
                        <td>{{ $cliente->cuota_mensual }}</td>
                        <td>{{ $cliente->pais->iso3 }}</td>
                        <td>{{ $cliente->moneda }}</td> --}}
                        <td>{{$sumasCuotas[$cliente->id]}}</td>
                        <td><a class="btn btn-danger" href="{{ route('mensajeBorrarCliente', $cliente) }}"
                                title="Borrar"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>