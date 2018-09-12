<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
     protected $table = 'clasificacion';

    protected $fillable = ['id', 'nombre'];
}
