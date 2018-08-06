<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $fillable = [
        'legajo', 'apellido y nombre', 'cuil',
    ];
}
