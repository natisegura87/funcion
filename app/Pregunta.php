<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = [
        'nombre','nivel_id','respuesta'
        
    ];

    public function nivel()
	{
	    return $this->belongsTo(Nivel::class);
	}

    /*public function turnos()
    {
        return $this->hasMany(Turno::class);
    }*/
}
