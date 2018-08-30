<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puestofuncionarios extends Model
{
    protected $table = 'puestofuncionarios';
    public $timestamps = false;

    protected $fillable = ['id', 'nombre','descripcion', 'regimen_id'];

   
}
