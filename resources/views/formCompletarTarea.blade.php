@section('titulo', 'Formulario Tarea')

@extends('base')

@section('contenido')
    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('validarCompletarTarea', $tarea) }}" method="post" enctype="multipart/form-data" class="row g-3"
        id="formulario">
        @csrf
        @method('PUT')

        <h2>Completar tarea {{ $tarea->id }}</h2> <br>

        <div class="col-md-6">
            <label for="anotaciones_anteriores" class="form-label">Anotaciones anteriores: </label>
            <textarea class="form-control" name="anotaciones_anteriores" placeholder="Anotaciones anteriores" cols="30"
                rows="3">{{ old('anotaciones_anteriores') ?? $tarea->anotaciones_anteriores }}</textarea>
            {!! $errors->first('anotaciones_anteriores', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-6">
            <label for="anotaciones_posteriores" class="form-label">Anotaciones posteriores: </label>
            <textarea class="form-control" name="anotaciones_posteriores" cols="30" rows="3">{{ old('anotaciones_posteriores') ?? $tarea->anotaciones_posteriores }}</textarea>
            {!! $errors->first('anotaciones_posteriores', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="fecha_realizacion" class="form-label">Fecha realización: </label>
            <input class="form-control" type="date" name="fecha_realizacion"
                value="{{ old('fecha_realizacion') ?? $tarea->fecha_realizacion }}">
            {!! $errors->first('fecha_realizacion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="fichero_resumen" class="form-label">Fichero resumen: </label>
            <input class="form-control" name="fichero_resumen" type="file">
            {!! $errors->first('fichero_resumen', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="estado" class="form-label">Estado: </label>
            <select class="form-select" name="estado">
                <option value="P" {{ old('estado') == 'P' ? 'selected' : ($tarea->estado == 'P' ? 'selected' : '') }}>
                    Pendiente</option>
                <option value="R" {{ old('estado') == 'R' ? 'selected' : ($tarea->estado == 'R' ? 'selected' : '') }}>
                    Realizada</option>
                <option value="C" {{ old('estado') == 'C' ? 'selected' : ($tarea->estado == 'C' ? 'selected' : '') }}>
                    Cancelada</option>
            </select>
            {!! $errors->first('estado', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <a class="btn btn-success" href="{{ route('listaTareasOperario') }}"><svg xmlns="http://www.w3.org/2000/svg"
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
