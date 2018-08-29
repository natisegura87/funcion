<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excluyentes extends Model
{
     protected $table = 'excluyentes';

    protected $fillable = ['id', 'nombre'];
}
