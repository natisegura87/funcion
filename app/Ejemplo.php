<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplo extends Model
{
    protected $table = 'ejemplo';

    protected $fillable = ['id', 'name', 'parent'];
}
