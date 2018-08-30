<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
     protected $table = 'regimen';

    protected $fillable = ['id', 'nombre'];
}
