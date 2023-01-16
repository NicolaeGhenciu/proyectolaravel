@section('titulo', 'Formulario Mantenimiento')

@extends('base')

@section('contenido')
    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('formMantenimientoCliente') }}" method="post" class="row g-3 needs-validation" id="formulario"
        novalidate>
        @csrf
        <h2>Formulario Mantenimiento</h2>
        <div class="col-md-3">
            <label for="concepto" class="form-label">Concepto: </label>
            <input class="form-control" type="text" name="concepto" value="{{ old('concepto') }}" placeholder="CONCEPTO">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="importe" class="form-label">Importe: </label>
            <input class="form-control" type="text" name="importe" value="{{ old('importe') }}" placeholder="IMPORTE">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="pagada" class="form-label">Pagada: </label>
            <select name="pagada" id="pagada" class="form-select">
                <option value="si">SI</option>
                <option value="no">NO</option>
            </select>
            {!! $errors->first('pagada', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="fechaDePago" class="form-label">Fecha de pago: </label>
            <input type="date" name="fechaDePago" class="form-control">
            {!! $errors->first('fechaDePago', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="notas" class="form-label">Notas: </label>
            <textarea class="form-control" name="notas" id="notas" cols="30" rows="5"></textarea>
            {!! $errors->first('notas', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection
