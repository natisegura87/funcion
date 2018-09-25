<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vincularpuesto extends Model
{
    protected $table = 'vincularpuesto';
    public $timestamps = false;

    protected $fillable = ['id','nomenclador_id', 'unidad_id','iddependencia',
    			'mision', 'funcion','localidad_id','op_id','generavacante','regimen_id'];


    public static function getdep($uni) // borrar
    {
    	$posibles=Vincularpuesto::where('unidad_id','<',$uni);
        		//->pluck('nomenclador_id');
        
        return $posibles;
       
    }
public static function get1($id) // borrar
    {
    return Vincularpuesto::where('nomenclador_id',$id)
                            ->first();
}

public static function primero() // borrar
    {
    return Vincularpuesto::first();
}

}
