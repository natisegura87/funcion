<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomencladorfuncionarios extends Model
{
    protected $table = 'nomencladorfuncionarios';
    public $timestamps = false;

    protected $fillable = ['id', 'nombrepuesto','descripcion', 'regimen_id'];

   
}
