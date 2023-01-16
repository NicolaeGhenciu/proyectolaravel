@section('titulo', 'Formulario Tarea')

@extends('base')

@section('contenido')
    <style>
        #formulario {
            margin: 2em;
        }
    </style>

    <form action="{{ route('formTarea') }}" method="post" class="row g-3" id="formulario">
        @csrf

        <h2>Formulario Tarea</h2>

        <div class="col-md-3">
            <label class="form-label"><b>Cliente que encarga del trabajo</b></label>
            <select class="form-select" name="" id="">
                <option value=""></option>
            </select>
        </div>

        <label class="form-label"><b>Persona de contacto</b></label>

        <div class="col-md-3">
            <label class="form-label">Nombre y Apellidos: </label>
            <input class="form-control" type="text" name="nombre" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Teléfono:</label>
            <input class="form-control" type="text" name="telefono" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Correo electrónico: </label>
            <input class="form-control" type="text" name="email" value="">
        </div>

        <label class="form-label"><b>Datos tarea</b></label>

        <div class="col-md-3">
            <label class="form-label">Descripción: </label>
            <textarea class="form-control" name="descripcion" cols="30" rows="3"></textarea>
        </div>


        <div class="col-md-3">
            <label class="form-label">Dirección: </label>
            <input class="form-control" type="text" name="direccion" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Población: </label>
            <input class="form-control" type="text" name="poblacion" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Codigo Postal: </label>
            <input class="form-control" type="text" name="codigo_postal" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Provincia: </label>
            <select class="form-select" name="provincia">
                @foreach ($provincias as $provincia)
                    <option value="{{ $provincia->cod }}">{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Estado: </label>
            <select class="form-select" name="estado">
                {{-- <option value="B">B=Esperando ser aprobada</option> --}}
                <option value="P">P=Pendiente</option>
                <option value="R">R=Realizada</option>
                <option value="C">C=Cancelada</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Operario encargado: </label>
            <select class="form-select" name="provincia">
                @foreach ($empleados as $empleado)
                    @if ($empleado->es_admin == 0)
                        <option value="{{ $empleado->nif }}">{{ $empleado->nombre }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Fecha de realización: </label>
            <input class="form-control" type="date" name="fecha_realizacion" value="">
        </div>

        <div class="col-md-3">
            <label class="form-label">Anotaciones anteriores: </label>
            <textarea class="form-control" name="anotaciones_anteriores" cols="30" rows="3"></textarea>
        </div>

        <div class="col-md-3">
            <label class="form-label">Anotaciones posteriores: </label>
            <textarea class="form-control" name="anotaciones_posteriores" cols="30" rows="3"></textarea>
        </div>

        <div class="col-md-3">
            <label class="form-label">Fichero resumen: </label>
            <input class="form-control" name="fichero_resumen" type="file" value="">
        </div>

        <div class="col-15">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>

    </form>

@endsection
