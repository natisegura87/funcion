<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subclasificacion extends Model
{
     protected $table = 'subclasificacion';

    protected $fillable = ['id', 'nombre','clasificacion_id'];
}
