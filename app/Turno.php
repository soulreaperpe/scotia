<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    
    protected $table = 'turnos';
    protected $fillable = [
        'codigo','descripcion','created_at', 'updated_at'
        
    ];
    public $timestamps = true;
}
