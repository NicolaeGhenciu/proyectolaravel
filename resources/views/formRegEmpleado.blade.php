@section('titulo', 'Registrar Empleados')

@extends('base')

@section('contenido')
    <style>
        #formulario,
        #encabezado {
            margin: 2em;
        }
    </style>

    <div id="encabezado">
        <h2>Formulario para el Registro de Empleados</h2> <br>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>

    <form action="{{ route('formRegEmpleado') }}" method="post" class="row g-3" id="formulario">
        @csrf

        <div class="col-md-3">
            <label for="nif" class="form-label">DNI/NIE: </label>
            <input class="form-control" type="text" name="nif" value="{{ old('nif') }}" placeholder="DNI/NIE">
            {!! $errors->first('nif', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="nombre_y_apellidos" class="form-label">Nombre y Apellidos:</label>
            <input class="form-control" type="text" name="nombre_y_apellidos" value="{{ old('nombre_y_apellidos') }}"
                placeholder="Nombre y apellidos">
            {!! $errors->first('nombre_y_apellidos', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="clave" class="form-label">Contraseña:</label>
            <input class="form-control" type="text" name="clave" value="{{ old('clave') }}" placeholder="Clave">
            {!! $errors->first('clave', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="fecha_alta" class="form-label">Fecha de alta: </label>
            <input class="form-control" type="date" name="fecha_alta" value="{{ old('fecha_alta') }}">
            {!! $errors->first('fecha_alta', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="correo" class="form-label">Correo:</label>
            <input class="form-control" type="text" name="correo" value="{{ old('correo') }}"
                placeholder="Correo Electronico">
            {!! $errors->first('correo', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Télefono">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>
        <div class="col-md-3">
            <label for="direccion" class="form-label">Dirección:</label>
            <input class="form-control" type="text" name="direccion" value="{{ old('nif') }}" placeholder="Dirección"
                {{ old('es_admin') == 0 ? 'checked' : '' }}>
            {!! $errors->first('direccion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label>Rol de la persona:</label> <br>
            <label for="operario" class="form-label">Operario</label>
            <input class="form-check-input" type="radio" id="es_admin" name="es_admin" value="0"
                {{ old('es_admin') == 'operario' ? 'checked' : '' }}>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <label for="administrador" class="form-label">Administrador</label>
            <input class="form-check-input" type="radio" id="es_admin" name="es_admin" value="1"
                {{ old('es_admin') == 'admin' ? 'checked' : '' }}>
            {!! $errors->first('es_admin', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>

    </form>
@endsection
