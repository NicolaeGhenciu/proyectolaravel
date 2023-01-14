@section('titulo', 'Registrar Empleados')

@extends('base')

@section('contenido')
<style>
    #formulario {
        margin: 2em;
    }
</style>

<form action="{{ route('formRegEmpleado') }}" method="post" class="row g-3" id="formulario">
    @csrf
    <h2>Formulario para el Registro de Empleados</h2>
    <div class="col-md-3">
        <label for="nif" class="from-label">DNI/NIE: </label>
        <input class="form-control" type="text" name="nif" value="{{ old('nif') }}" placeholder="DNI/NIE">
        {!! $errors->first('nif', '<b>:message</b>') !!}
    </div>
    <div class="col-md-3">
        <label for="nombre" class="from-label">Nombre y Apellidos:</label>
        <input class="form-control" type="text" name="nombre" value="{{ old('nombre') }}"
            placeholder="Nombre y Apellidos">
        {!! $errors->first('nombre', '<b>:message</b>') !!}
    </div>
    <div class="col-md-3">
        <label for="correo" class="from-label">Correo</label>
        <input class="form-control" type="text" name="correo" value="{{ old('correo') }}"
            placeholder="Correo Electronico">
        {!! $errors->first('correo', '<b>:message</b>') !!}
    </div>
    <div class="col-md-3">
        <label for="telefono" class="from-label">Teléfono</label>
        <input class="form-control" type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Télefono">
        {!! $errors->first('telefono', '<b>:message</b>') !!}
    </div>
    <div class="col-md-3">
        <label for="direccion" class="from-label">Dirección</label>
        <input class="form-control" type="text" name="direccion" value="{{ old('nif') }}" placeholder="Dirección"
            {{ old('es_admin') == 0 ? 'checked' : '' }}>
        {!! $errors->first('direccion', '<b>:message</b>') !!}
    </div>
    <div class="col-md-3">
        <label for="operario" class="from-label">Operario</label><input class="form-check-input" type="radio"
            id="es_admin" name="es_admin" value="operario" {{ old('es_admin') == 'operario' ? 'checked' : '' }}>
        <span>&nbsp;&nbsp;</span>
        <label for="administrador" class="from-label">Administrador</label><input class="form-check-input"
            type="radio" id="es_admin" name="es_admin" value="admin"
            {{ old('es_admin') == 'admin' ? 'checked' : '' }}>
        {!! $errors->first('es_admin', '<b>:message</b>') !!}
    </div>
    <div class="col-15">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

</form>
@endsection