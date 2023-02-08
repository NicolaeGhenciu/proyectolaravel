<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Empleado extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'empleados';
    public $timestamps = false;
    protected $fillable = ['nif', 'nombre_y_apellidos', 'password', 'fecha_alta', 'email', 'telefono', 'direccion', 'es_admin'];
}
