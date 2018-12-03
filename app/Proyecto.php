<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    
    protected $table = 'proyectos';
    protected $fillable = [
        'nombre','inicio', 'descripcion', 'fin','created_at', 'updated_at'
        
    ];
    public $timestamps = true;
}
