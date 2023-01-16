@section('titulo', 'Registrar Clientes')

@extends('base')

@section('contenido')
    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('formRegCliente') }}" method="post" class="row g-3" id="formulario">
        @csrf
        <h2>Formulario para el Registro de Clientes</h2>
        <div class="col-md-3">
            <label for="nif" class="form-label">CIF: </label>
            <input class="form-control" type="text" name="cif" value="{{ old('cif') }}" placeholder="CIF">
            {!! $errors->first('cif', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="nombre" class="form-label">Nombre y Apellidos:</label>
            <input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}"
                placeholder="Nombre y Apellidos">
            {!! $errors->first('nombre', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Télefono">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="correo" class="form-label">Correo:</label>
            <input class="form-control" type="text" name="correo" value="{{ old('correo') }}"
                placeholder="Correo Electronico">
            {!! $errors->first('correo', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="cuentaCorriente" class="form-label">Cuenta Corriente:</label>
            <input class="form-control" type="text" name="cuentaCorriente" value="{{ old('cuentaCorriente') }}"
                placeholder="Cuenta Corriente">
            {!! $errors->first('cuentaCorriente', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="importeCuotaMensual" class="form-label">Importe cuota mensual:</label>
            <input class="form-control" type="text" name="importeCuotaMensual" value="{{ old('importeCuotaMensual') }}"
                placeholder="Importe cuota mensual">
            {!! $errors->first('importeCuotaMensual', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="paises" class="form-label">Paises:</label>
            <select class="form-select" name="paises">
                @foreach ($paises as $pais)
                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="monedas" class="form-label">Monedas:</label>
            <select class="form-select" name="monedas">
                <?php $monedasMostradas = []; ?>
                @foreach ($paises as $pais)
                    @if ($pais->nombre_moneda == null)
                    @else
                        @if (!in_array($pais->nombre_moneda, $monedasMostradas))
                            <?php array_push($monedasMostradas, $pais->nombre_moneda); ?>
                            <option value="{{ $pais->nombre_moneda }}">{{ $pais->nombre_moneda }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>

    </form>
@endsection
