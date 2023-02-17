@section('titulo', 'Formulario Mantenimiento')

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

    <form action="{{ route('modificarCuota', $cuota) }}" method="post" class="row g-3 needs-validation" id="formulario">
        @csrf
        @method('PUT')

        <h2>Modificar cuota {{ $cuota->id }}</h2> <br>

        <div class="col-md-3">
            <label class="form-label">Cliente: </label>
            <select class="form-select" name="clientes_id">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('clientes_id') == $cliente->id ? 'selected' : ($cuota->clientes_id == $cliente->id ? 'selected' : '') }}>
                        {{ $cliente->nombre_y_apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="concepto" class="form-label">Concepto: </label>
            <input class="form-control" type="text" name="concepto" value="{{ old('concepto') ?? $cuota->concepto }}"
                placeholder="CONCEPTO">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="fecha_emision" class="form-label">Fecha de emisión: </label>
            <input class="form-control" type="date" name="fecha_emision"
                value="{{ old('fecha_emision') ?? $cuota->fecha_emision }}">
            {!! $errors->first('fecha_emision', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="importe" class="form-label">Importe: </label>
            <input class="form-control" type="text" name="importe" value="{{ old('importe') ?? $cuota->importe }}"
                placeholder="IMPORTE">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="pagada" class="form-label">Pagada: </label>
            <select name="pagada" id="pagada" class="form-select">
                <option value="SI"
                    {{ old('pagada') == 'SI' ? 'selected' : ($cuota->pagada == 'SI' ? 'selected' : '') }}>
                    SI</option>
                <option value="NO"
                    {{ old('pagada') == 'NO' ? 'selected' : ($cuota->pagada == 'NO' ? 'selected' : '') }}>
                    NO</option>
            </select>
            {!! $errors->first('pagada', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="fecha_pago" class="form-label">Fecha de pago: </label>
            <input type="date" name="fecha_pago" class="form-control"
                value="{{ old('fecha_pago') ?? $cuota->fecha_pago }}">
            {!! $errors->first('fecha_pago', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="notas" class="form-label">Notas: </label>
            <textarea class="form-control" name="notas" id="notas" cols="30" rows="4">{{ old('notas') ?? $cuota->notas }}</textarea>
            {!! $errors->first('notas', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <a class="btn btn-success" href="{{ route('listaCuotas', 'fecha_emision') }}"><i class="bi bi-arrow-left"></i>
                Volver atras</a>
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>
    </form>

@endsection
