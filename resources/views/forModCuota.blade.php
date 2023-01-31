@section('titulo', 'Formulario Mantenimiento')

@extends('base')

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
            <a class="btn btn-success" href="{{ route('listaCuotas') }}"><svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg> Volver atras</a>
            <button type="submit" class="btn btn-primary">Enviar <svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                </svg></button>
        </div>
    </form>

@endsection
