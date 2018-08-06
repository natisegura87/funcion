<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nivel;

class Organigrama extends Model
{
    protected $fillable = [
        'nombre'
        
    ];

    /*public function turnos()
    {
        return $this->hasMany(Turno::class);
    }*/

    public static function nivel($id){
		$nivel = Nivel::all()
                        ->where('id',$id)
                        ->pluck('nivel');
        //dd($nivel->first());
        return $nivel->first();
        //return Nivel::where('id',$id)->get();
    }
}
