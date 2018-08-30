<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad1 extends Model
{
     protected $table = 'unidad1';

    protected $fillable = ['id', 'nombre','parafuncionario'];
}
