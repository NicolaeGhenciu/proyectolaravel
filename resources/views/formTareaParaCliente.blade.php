<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incidencia/Traea Cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

    <script>
        $(document).ready(function() {
            $('.form-select').select2();
        });
    </script>
    <style>
        #formulario,
        #encabezado {
            margin: 2em;
        }
    </style>
</head>

<body>
    <div id="encabezado">
        <h3>🏗️ <b>SIEMPRECOLGADOS S.A</b></h3>
        <hr>
        <h4>Registar Tarea como Cliente</h4> <br>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>

    <form action="{{ route('formTareaParaClientes') }}" method="post" class="row g-3" id="formulario">
        @csrf

        <label class="form-label"><b>Cliente que encarga del trabajo</b></label>

        <div class="col-md-3">
            <label for="cliente_cif" class="form-label">CIF:</label>

            <input class="form-control" type="text" name="cliente_cif" placeholder="CIF"
                value="{{ old('cliente_cif') }}">
            {!! $errors->first('cliente_cif', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono_cliente" class="form-label">Télefono</label>

            <input class="form-control" type="text" name="telefono_cliente" placeholder="Teléfono"
                value="{{ old('telefono_cliente') }}">
            {!! $errors->first('telefono_cliente', '<b style="color: red">:message</b>') !!}
        </div>

        <label class="form-label"><b>Persona de contacto</b></label>

        <div class="col-md-3">
            <label for="nombre_y_apellidos" class="form-label">Nombre y Apellidos: </label>
            <input class="form-control" type="text" name="nombre_y_apellidos" placeholder="Nombre y apellidos"
                value="{{ old('nombre_y_apellidos') }}">
            {!! $errors->first('nombre_y_apellidos', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" placeholder="Teléfono"
                value="{{ old('telefono') }}">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="correo" class="form-label">Correo electrónico: </label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input class="form-control" type="text" name="correo" placeholder="Correo electrónico"
                    value="{{ old('correo') }}">
            </div>

            {!! $errors->first('correo', '<b style="color: red">:message</b>') !!}
        </div>

        <label class="form-label"><b>Datos tarea</b></label>

        <div class="col-md-3">
            <label for="descripcion" class="form-label">Descripción: </label>
            <textarea class="form-control" name="descripcion" placeholder="Descripción" cols="30" rows="3">{{ old('descripcion') }}</textarea>
            {!! $errors->first('descripcion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="direccion" class="form-label">Dirección: </label>
            <input class="form-control" type="text" name="direccion" placeholder="Dirección"
                value="{{ old('direccion') }}">
            {!! $errors->first('direccion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="poblacion" class="form-label">Población: </label>
            <input class="form-control" type="text" name="poblacion" placeholder="Población"
                value="{{ old('poblacion') }}">
            {!! $errors->first('poblacion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="codigo_postal" class="form-label">Código Postal: </label>
            <input class="form-control" type="text" name="codigo_postal" placeholder="Código Postal"
                value="{{ old('codigo_postal') }}">
            {!! $errors->first('codigo_postal', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label class="form-label">Provincia: </label>
            <select class="form-select" name="provincias_cod">
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->cod }}"
                        {{ old('provincias_cod') == $provincia->cod ? 'selected' : '' }}>
                        {{ $provincia->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="fecha_realizacion" class="form-label">Fecha de realización: </label>
            <input class="form-control" type="date" name="fecha_realizacion"
                value="{{ old('fecha_realizacion') }}">
            {!! $errors->first('fecha_realizacion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <a class="btn btn-success" href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Volver atras</a>
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

</body>

</html>
