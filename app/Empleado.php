<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    
    protected $table = 'empleados';
    protected $fillable = [
        'codigo','nombres', 'apellidos', 'activo','created_at', 'updated_at'
        
    ];
    public $timestamps = true;
}
