<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puesto';

    protected $fillable = ['id', 'nombre'];


    public function hijos($idpadre)
    {
        return App\Puesto::all()->where('idpadre',$id);
        //$this->hasMany('App\Order');
    }

}
