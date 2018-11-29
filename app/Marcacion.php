<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcacion extends Model
{
    
    protected $table = 'marcacions';
    protected $fillable = [
        'idEmpleado','idTurno', 'entrada', 'salida','minutosTardanza','horasEfectivas','minutosEfectivos','created_at', 'updated_at'
        
    ];
    public $timestamps = true;
}
