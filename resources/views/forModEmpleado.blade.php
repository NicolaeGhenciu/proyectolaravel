@section('titulo', 'Modificar Empleado')

@extends('base')

@section('contenido')

    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('modificarEmpleado', $empleado) }}" method="post" class="row g-3" id="formulario">
        @csrf
        @method('PUT')

        <h2>Modificar empleado {{ $empleado->id }}</h2> <br>

        <div class="col-md-3">
            <label for="nif" class="form-label">DNI/NIE: </label>
            <input class="form-control" type="text" name="nif" value="{{ old('nif') ?? $empleado->nif }}"
                placeholder="DNI/NIE">
            {!! $errors->first('nif', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="nombre_y_apellidos" class="form-label">Nombre y Apellidos:</label>
            <input class="form-control" type="text" name="nombre_y_apellidos"
                value="{{ old('nombre_y_apellidos') ?? $empleado->nombre_y_apellidos }}" placeholder="Nombre y apellidos">
            {!! $errors->first('nombre_y_apellidos', '<b style="color: red">:message</b>') !!}
        </div>

        {{-- <div class="col-md-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input class="form-control" type="text" name="password" value="{{ old('password') ?? $empleado->password }}"
                placeholder="Contraseña">
            {!! $errors->first('password', '<b style="color: red">:message</b>') !!}
        </div> --}}

        <div class="col-md-3">
            <label for="fecha_alta" class="form-label">Fecha de alta: </label>
            <input class="form-control" type="date" name="fecha_alta"
                value="{{ old('fecha_alta') ?? $empleado->fecha_alta }}">
            {!! $errors->first('fecha_alta', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="email" class="form-label">Correo electrónico: </label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input class="form-control" type="text" name="email" placeholder="Correo electrónico"
                    value="{{ old('email') ?? $empleado->email }}">
            </div>

            {!! $errors->first('email', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="{{ old('telefono') ?? $empleado->telefono }}"
                placeholder="Télefono">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label for="direccion" class="form-label">Dirección:</label>
            <input class="form-control" type="text" name="direccion"
                value="{{ old('direccion') ?? $empleado->direccion }}" placeholder="Dirección">
            {!! $errors->first('direccion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-3">
            <label>Rol del empleado:</label>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="operario" name="es_admin" value="0"
                        {{ old('es_admin', $empleado->es_admin) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="operario">👨🏻‍🔧 Operario</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="administrador" name="es_admin" value="1"
                        {{ old('es_admin', $empleado->es_admin) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="administrador">👨🏻‍💼 Administrador</label>
                </div>
                {!! $errors->first('es_admin', '<b style="color: red">:message</b>') !!}
            </div>
        </div>

        <div class="col-15">
            <a class="btn btn-success" href="{{ route('listaEmpleados') }}"><i class="bi bi-arrow-left"></i> Volver
                atras</a>
            <button type="submit" class="btn btn-primary">Enviar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

@endsection
