<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subagrupamiento extends Model
{
     protected $table = 'subagrupamiento';

    protected $fillable = ['id', 'nombre','agrupamiento_id'];
}
