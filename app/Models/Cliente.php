<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    protected $fillable = ['cif', 'nombre_y_apellidos', 'telefono', 'correo', 'cuenta_corriente', 'importe_cuota_mensual','pais','moneda'];
}
