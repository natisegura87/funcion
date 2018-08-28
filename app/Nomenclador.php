<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomenclador extends Model
{
    protected $table = 'nomenclador';

    protected $fillable = ['id', 'nombrepuesto', 'nivel_id', 'agrupamiento_id','op_codigo', 'complejidad', 'responsabilidad', 'autonomia'];


    public static function puesto($id)
    {
        $unidad=Unidad::find($id);
        //$or= Puesto::where('unidad_id','=',$id)->orderBy('iddependencia', 'ASC')->first();
        //dd($or);
        return Puesto::where('unidad_id','=',$id)
                    ->orderBy('iddependencia', 'ASC')->first(); //
    }

    public static function puestos($id)
    {
        $unidad=Unidad::find($id);
        $or= $unidad->orden;
        //dd($or);
        return Puesto::where('unidad_id','<',$id)->get(); 
    }

    public static function puestosDep($id) // borrar
    {
        $unidad=Unidad::find($id);
        $or= $unidad->orden;
        //dd($or);
        return Puesto::where('unidad_id',$id)->get(); 
    }

    public static function puestosHijos($id)
    {        
        return Puesto::where('unidad_id','>=',$id) 
                    ->get(); 
    }

    public function nivel()
	{
	    return $this->belongsTo(Nivel::class);
	}

	public function unidad()
	{
	    return $this->belongsTo(Unidad::class);
	}

}
