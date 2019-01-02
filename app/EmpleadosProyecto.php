<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadosProyecto extends Model
{
    
    protected $table = 'empleadosproyecto';
    protected $fillable = [
        'idProyecto','idEmpleado','created_at', 'updated_at'
        
    ];
    public $timestamps = true;
}
