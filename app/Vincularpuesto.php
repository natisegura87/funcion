<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vincularpuesto extends Model
{
    protected $table = 'vincularpuesto';
    public $timestamps = false;

    protected $fillable = ['id','nomenclador_id', 'unidad_id','iddependencia','mision', 'funcion'];


    public static function getdep($uni) // borrar
    {
    	$posibles=Vincularpuesto::where('unidad_id','<',$uni);
        		//->pluck('nomenclador_id');
        
        return $posibles;
       
    }

}
