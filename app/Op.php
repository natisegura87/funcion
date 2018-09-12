<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Op extends Model
{
    protected $table = 'op';

    protected $fillable = ['codigo', 'organismos', 'denominacion'];


    public static function repetidos($selec){
		return Op::select($selec)->distinct()->get();
    }
}
