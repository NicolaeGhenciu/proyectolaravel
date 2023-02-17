@section('titulo', 'Registrar Clientes')

@extends('base')

@section('linkScript')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.form-select').select2();
        });
    </script>

@endsection


@section('contenido')
    <style>
        #formulario,
        #encabezado {
            margin: 2em;
        }
    </style>

    <div id="encabezado">
        <h2>Formulario para el Registro de Clientes</h2> <br>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>

    <form action="{{ route('formRegCliente') }}" method="post" class="row g-3" id="formulario">
        @csrf

        <div class="col-md-3">
            <label for="cif" class="form-label">CIF: </label>
            <input class="form-control" type="text" name="cif" value="{{ old('cif') }}" placeholder="CIF">
            {!! $errors->first('cif', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="nombre_y_apellidos" class="form-label">Nombre y Apellidos:</label>
            <input class="form-control" type="text" name="nombre_y_apellidos" value="{{ old('nombre_y_apellidos') }}"
                placeholder="Nombre y Apellidos">
            {!! $errors->first('nombre_y_apellidos', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Télefono">
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

        <div class="col-md-3">
            <label for="cuenta_corriente" class="form-label">Cuenta Corriente:</label>
            <input class="form-control" type="text" name="cuenta_corriente" value="{{ old('cuenta_corriente') }}"
                placeholder="Cuenta Corriente">
            {!! $errors->first('cuenta_corriente', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="cuota_mensual" class="form-label">Importe cuota mensual:</label>
            <input class="form-control" type="text" name="cuota_mensual" value="{{ old('cuota_mensual') }}"
                placeholder="Importe cuota mensual">
            {!! $errors->first('cuota_mensual', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="pais" class="form-label">Paises:</label>
            <select class="form-select" name="pais_id">
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
                        {{ $pais->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="moneda" class="form-label">Monedas:</label>
            <select class="form-select" name="moneda">
                <?php $monedasMostradas = []; ?>
                @foreach ($paises as $pais)
                    @if ($pais->nombre_moneda == null)
                    @else
                        @if (!in_array($pais->nombre_moneda, $monedasMostradas))
                            <?php array_push($monedasMostradas, $pais->nombre_moneda); ?>
                            <option value="{{ $pais->nombre_moneda }}"
                                {{ old('moneda') == $pais->nombre_moneda ? 'selected' : '' }}>
                                {{ $pais->nombre_moneda }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>
@endsection
