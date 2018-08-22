<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agrupamiento extends Model
{
     protected $table = 'agrupamiento';

    protected $fillable = ['id', 'nombre'];
}
