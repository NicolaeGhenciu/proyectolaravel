@section('titulo', 'Formulario Mantenimiento')

@extends('base')

@section('contenido')
    <style>
        #formulario,
        #encabezado {
            margin: 2em;
        }
    </style>

    <div id="encabezado">
        <h2>Remesa mensual a todos los clientes</h2> <br>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>

    <form action="{{ route('formRemesaMensual') }}" method="post" class="row g-3 needs-validation" id="formulario">
        @csrf

        <div class="col-md-6">
            <label for="concepto" class="form-label">Concepto: </label>
            <input class="form-control" type="text" name="concepto" value="{{ old('concepto') }}" placeholder="CONCEPTO">
            {!! $errors->first('concepto', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-6">
            <label for="fecha_alta" class="form-label">Fecha de emisión: </label>
            <input class="form-control" type="date" name="fecha_emision" value="{{ old('fecha_emision') }}">
            {!! $errors->first('fecha_emision', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-6">
            <label for="notas" class="form-label">Notas: </label>
            <textarea class="form-control" name="notas" id="notas" cols="30" rows="4">{{ old('notas') }}</textarea>
            {!! $errors->first('notas', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

@endsection
