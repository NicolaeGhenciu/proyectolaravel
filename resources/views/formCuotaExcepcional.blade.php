@section('titulo', 'Formulario Mantenimiento')

@section('linkScript')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.form-select').select2();
        });
    </script>

@endsection

@extends('base')

@section('contenido')
    <style>
        #formulario,
        #encabezado {
            margin: 2em;
        }
    </style>

    <div id="encabezado">
        <h2>Formulario cuota excepcional</h2> <br>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>

    <form action="{{ route('formularioCuota') }}" method="post" class="row g-3 needs-validation" id="formulario">
        @csrf

        {{-- <div class="col-md-3">
            <label class="form-label">Cliente: </label>
            <select class="form-select" name="clientes_id">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('clientes_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre_y_apellidos }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="col-2 md-3">
            <label class="form-label">Cliente: </label>
            <select class="form-select" name="clientes_id">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('clientes_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre_y_apellidos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="concepto" class="form-label">Concepto: </label>
            <input class="form-control" type="text" name="concepto" value="{{ old('concepto') }}" placeholder="CONCEPTO">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="fecha_alta" class="form-label">Fecha de emisión: </label>
            <input class="form-control" type="date" name="fecha_emision" value="{{ old('fecha_emision') }}">
            {!! $errors->first('fecha_emision', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="importe" class="form-label">Importe: </label>
            <input class="form-control" type="text" name="importe" value="{{ old('importe') }}" placeholder="IMPORTE">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>

        {{-- <div class="col-md-3">
            <label for="pagada" class="form-label">Pagada: </label>
            <select name="pagada" id="pagada" class="form-select">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
            {!! $errors->first('pagada', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="fecha_pago" class="form-label">Fecha de pago: </label>
            <input type="date" name="fecha_pago" class="form-control" value="{{ old('fecha_pago') }}">
            {!! $errors->first('fecha_pago', '<b style="color: red">:message</b>') !!}
        </div> --}}

        <div class="col-md-3">
            <label for="notas" class="form-label">Notas: </label>
            <textarea class="form-control" name="notas" id="notas" cols="30" rows="4">{{ old('notas') }}</textarea>
            {!! $errors->first('notas', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

@endsection
