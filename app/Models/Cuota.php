<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = 'cuotas';
    public $timestamps = false;
    protected $fillable = ['clientes_id', 'concepto', 'fecha_emision', 'importe', 'pagada','fecha_pago','notas'];
}
