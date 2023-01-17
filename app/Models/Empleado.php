<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    public $timestamps = false;
    protected $fillable = ['nif', 'nombre_y_apellidos', 'clave', 'fecha_alta', 'correo', 'telefono', 'direccion', 'es_admin'];
}
