<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puesto';

    protected $fillable = ['id', 'nombre', 'nivel_id', 'agrupamiento_id', 'empleado','unidad_id','iddependencia','op_codigo', 'complejidad', 'responsabilidad', 'autonomia'];


    public static function puesto($id)
    {
        $unidad=Unidad::find($id);
        //$or= Puesto::where('unidad_id','=',$id)->orderBy('iddependencia', 'ASC')->first();
        //dd($or);
        return Puesto::where('unidad_id','=',$id)
                    ->orderBy('iddependencia', 'ASC')->first(); //ver si orden o id
        //return App\Puesto::all()->where('idpadre',$id);
        //$this->hasMany('App\Order');
    }

    public static function puestos($id)
    {
        $unidad=Unidad::find($id);
        $or= $unidad->orden;
        //dd($or);
        return Puesto::where('unidad_id','<',$id)->get(); //ver si orden o id
        //return App\Puesto::all()->where('idpadre',$id);
        //$this->hasMany('App\Order');
    }

    public static function puestosDep($id) // borrar
    {
        $unidad=Unidad::find($id);
        $or= $unidad->orden;
        //dd($or);
        return Puesto::where('unidad_id',$id)->get(); //ver si orden o id
        //return App\Puesto::all()->where('idpadre',$id);
        //$this->hasMany('App\Order');
    }

    public static function puestosHijos($id)
    {        
        return Puesto::where('unidad_id','>=',$id) 
                    ->get(); //ver si orden o id
        //return App\Puesto::all()->where('idpadre',$id);
        //$this->hasMany('App\Order');
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
