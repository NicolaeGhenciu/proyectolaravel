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
            <label for="password" class="form-label">Contraseña:</label>
            <input class="form-control" type="text" name="password" value="{{ old('password') }}"
                placeholder="Contraseña">
            {!! $errors->first('password', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="fecha_alta" class="form-label">Fecha de alta: </label>
            <input class="form-control" type="date" name="fecha_alta" value="{{ old('fecha_alta') }}">
            {!! $errors->first('fecha_alta', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="email" class="form-label">Correo electrónico: </label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input class="form-control" type="text" name="email" placeholder="Correo electrónico"
                    value="{{ old('email') }}">
            </div>
            {!! $errors->first('email', '<b style="color: red">:message</b>') !!}
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
            <label>Rol del empleado:</label>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="operario" name="es_admin" value="0"
                        {{ old('es_admin') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="operario">👨🏻‍🔧 Operario</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="administrador" name="es_admin" value="1"
                        {{ old('es_admin') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="administrador">👨🏻‍💼 Administrador</label>
                </div>
                {!! $errors->first('es_admin', '<b style="color: red">:message</b>') !!}
            </div>
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar <svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                </svg></button>
        </div>

    </form>

@endsection
