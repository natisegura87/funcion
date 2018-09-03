<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nivel;
use App\Vincularpuesto;

class Organigrama extends Model
{
    protected $fillable = [
        'nombre'
        
    ];

    /*public function turnos()
    {
        return $this->hasMany(Turno::class);
    }*/

    public static function getPuesto($id){
        $puesto=Vincularpuesto::where('nomenclador_id',$id)->get();
        return $puesto;
    }

    public static function nivel($id){
		$nivel = Nivel::all()
                        ->where('id',$id)
                        ->pluck('nivel');
        //dd($nivel->first());
        return $nivel->first();
        //return Nivel::where('id',$id)->get();
    }
}
