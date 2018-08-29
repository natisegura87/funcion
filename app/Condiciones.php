<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condiciones extends Model
{
     protected $table = 'condicionesexcluyentes';

    protected $fillable = ['id', 'nombre','excluyente_id'];
}
