@section('titulo', 'Formulario Tarea')

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
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('modificarTarea', $tarea) }}" method="post" enctype="multipart/form-data" class="row g-3"
        id="formulario">
        @csrf
        @method('PUT')

        <h2>Modificar tarea {{ $tarea->id }}</h2> <br>

        <div class="col-md-3">
            <label for="clientes_id" class="form-label"><b>Cliente que encarga del trabajo</b></label>
            <select class="form-select" name="clientes_id">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('clientes_id') == $cliente->id ? 'selected' : ($tarea->clientes_id == $cliente->id ? 'selected' : '') }}>
                        {{ $cliente->nombre_y_apellidos }}</option>
                @endforeach
            </select>
        </div>

        <label class="form-label"><b>Persona de contacto</b></label>

        <div class="col-md-3">
            <label for="nombre_y_apellidos" class="form-label">Nombre y Apellidos: </label>
            <input class="form-control" type="text" name="nombre_y_apellidos" placeholder="Nombre y apellidos"
                value="{{ old('nombre_y_apellidos') ?? $tarea->nombre_y_apellidos }}">
            {!! $errors->first('nombre_y_apellidos', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" placeholder="Teléfono"
                value="{{ old('telefono') ?? $tarea->telefono }}">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="correo" class="form-label">Correo electrónico: </label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input class="form-control" type="text" name="correo" placeholder="Correo electrónico"
                    value="{{ old('correo') ?? $tarea->correo }}">
            </div>
            {!! $errors->first('correo', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="descripcion" class="form-label">Descripción: </label>
            <textarea class="form-control" name="descripcion" placeholder="Descripción" cols="30" rows="3">{{ old('descripcion') ?? $tarea->descripcion }}</textarea>
            {!! $errors->first('descripcion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="direccion" class="form-label">Dirección: </label>
            <input class="form-control" type="text" name="direccion" placeholder="Dirección"
                value="{{ old('direccion') ?? $tarea->direccion }}">
            {!! $errors->first('direccion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="poblacion" class="form-label">Población: </label>
            <input class="form-control" type="text" name="poblacion" placeholder="Población"
                value="{{ old('poblacion') ?? $tarea->poblacion }}">
            {!! $errors->first('poblacion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="codigo_postal" class="form-label">Código Postal: </label>
            <input class="form-control" type="text" name="codigo_postal" placeholder="Código Postal"
                value="{{ old('codigo_postal') ?? $tarea->codigo_postal }}">
            {!! $errors->first('codigo_postal', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="provincias_cod" class="form-label">Provincia: </label>
            <select class="form-select" name="provincias_cod">
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->cod }}"
                        {{ old('provincias_cod') == $provincia->cod ? 'selected' : ($tarea->provincia->cod == $provincia->cod ? 'selected' : '') }}>
                        {{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
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

        <div class="col-md-2">
            <label for="empleados_id" class="form-label">Operario encargado: </label>
            <select class="form-select" name="empleados_id">
                @foreach ($empleados as $empleado)
                    @if ($empleado->es_admin == 0)
                        <option value="{{ $empleado->id }}"
                            {{ old('empleados_id') == $empleado->id || (old('empleados_id') == null && $tarea->empleados_id == $empleado->id) ? 'selected' : '' }}>
                            {{ $empleado->nombre_y_apellidos }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="fecha_creacion" class="form-label">Fecha creación: </label>
            <span type="text" name="fecha_creacion" class="form-control" id="fecha_creacion"
                placeholder="fecha_creacion">{{ date('d-m-Y', strtotime($tarea->fecha_creacion)) }}</span>
        </div>

        <div class="col-md-2">
            <label for="fecha_realizacion" class="form-label">Fecha realización: </label>
            <input class="form-control" type="date" name="fecha_realizacion"
                value="{{ old('fecha_realizacion') ?? $tarea->fecha_realizacion }}">
            {!! $errors->first('fecha_realizacion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="anotaciones_anteriores" class="form-label">Anotaciones anteriores: </label>
            <textarea class="form-control" name="anotaciones_anteriores" placeholder="Anotaciones anteriores" cols="30"
                rows="3">{{ old('anotaciones_anteriores') ?? $tarea->anotaciones_anteriores }}</textarea>
            {!! $errors->first('anotaciones_anteriores', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="anotaciones_posteriores" class="form-label">Anotaciones posteriores: </label>
            <textarea class="form-control" name="anotaciones_posteriores" cols="30" rows="3">{{ old('anotaciones_posteriores') ?? $tarea->anotaciones_posteriores }}</textarea>
            {!! $errors->first('anotaciones_posteriores', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-2">
            <label for="fichero_resumen" class="form-label">Fichero resumen: </label>
            <input class="form-control" name="fichero_resumen" type="file">
            {!! $errors->first('fichero_resumen', '<b style="color: red">:message</b>') !!}
        </div>

        {{-- {{ $tarea->fichero_resumen }} --}}
        <div class="col-15">
            <a class="btn btn-success" href="{{ route('listaTareas') }}"><i class="bi bi-arrow-left"></i> Volver
                atras</a>
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

@endsection
