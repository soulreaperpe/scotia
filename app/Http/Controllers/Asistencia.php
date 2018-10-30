<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'asistencias';
    public $timestamps = false;
    protected $dateFormat = 'Y-m-d H:i:s';
}
