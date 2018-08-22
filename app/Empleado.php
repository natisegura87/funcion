<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $fillable = [
        'legajo', 'apellido_nombre', 'cuil','agrup'
    ];
}
