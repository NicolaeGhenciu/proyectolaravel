<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    public $timestamps = false;
    protected $fillable = ['clientes_id', 'nombre_y_apellidos', 'telefono', 'correo', 'descripcion', 'direccion', 'poblacion', 'codigo_postal', 'provincia', 'estado', 'empleados_id', 'fecha_creacion', 'fecha_realizacion', 'anotaciones_anteriores', 'anotaciones_posteriores', 'fichero'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'clientes_id');
    }

    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado', 'empleados_id');
    }
}
