@section('titulo', 'Mi Cuenta')

@extends('base')

@section('contenido')

    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('modificarMiCuenta', $empleado) }}" method="post" class="row g-3" id="formulario">
        @csrf
        @method('PUT')

        <h2> {{ $empleado->nombre_y_apellidos }} - NIF: {{ $empleado->nif }}</h2> <br>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h4>Datos de Contacto</h4>

        <div class="col-md-4">
            <label for="email" class="form-label">Correo electrónico: </label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input class="form-control" type="text" name="email" placeholder="Correo electrónico"
                    value="{{ old('email') ?? $empleado->email }}">
            </div>
            {!! $errors->first('email', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="{{ old('telefono') ?? $empleado->telefono }}"
                placeholder="Télefono">
            {!! $errors->first('telefono', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="direccion" class="form-label">Dirección:</label>
            <input class="form-control" type="text" name="direccion"
                value="{{ old('direccion') ?? $empleado->direccion }}" placeholder="Dirección">
            {!! $errors->first('direccion', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-md-4">
            <label for="fecha_alta" class="form-label">Fecha de alta: </label>
            <input class="form-control" type="date" name="fecha_alta"
                value="{{ old('fecha_alta') ?? $empleado->fecha_alta }}">
            {!! $errors->first('fecha_alta', '<b style="color: red">:message</b>') !!}
        </div>

        <div class="col-15">
            @if (Auth::check() && Auth::user()->es_admin === 0)
                <a class="btn btn-success" href="{{ route('listaTareasOperario') }}"><i class="bi bi-arrow-left"></i> Volver
                    atras</a>
            @endif
            @if (Auth::check() && Auth::user()->es_admin === 1)
                <a class="btn btn-success" href="{{ route('listaTareas') }}"><i class="bi bi-arrow-left"></i> Volver
                    atras</a>
            @endif
            <button type="submit" class="btn btn-primary">Modificar <i class="bi bi-arrow-right"></i></button>
        </div>

    </form>

@endsection
