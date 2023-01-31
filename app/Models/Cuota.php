<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuota extends Model
{

    use SoftDeletes;
    
    protected $table = 'cuotas';
    public $timestamps = false;
    protected $fillable = ['clientes_id', 'concepto', 'fecha_emision', 'importe', 'pagada', 'fecha_pago', 'notas'];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'clientes_id');
    }
}
