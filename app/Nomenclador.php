<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomenclador extends Model
{
    protected $table = 'nomenclador';
    public $timestamps = false;

    protected $fillable = ['id', 'nombrepuesto','descripcion', 'nivel_id', 
    'regimen_id', 'agrupamiento_id','subagrupamiento_id','clasificacion_id','subclasificacion_id',
    'genteacargo', 'complejidad', 'responsabilidad', 
    'autonomia','condiciones','organismos','codigo'];


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

    public function search(Array $data)
    {
        $busqueda = $this->where(function($query) use ($data) {
            if(isset($data['codigo']))
                $query->where('codigo',$data['codigo']);
             if(isset($data['nombre']))
                $query->where('nombrepuesto',$data['nombre']);
            if(isset($data['agrupamiento']))
                $query->where('agrupamiento_id',$data['agrupamiento']);           

        })//->toSql();dd($busqueda);
        ->paginate(5);
        return $busqueda;
    }

    public function scopeNombre($query, $name)
    { //dd("noh");
        if($name)
            return $query->where('nombrepuesto','LIKE', "%$name%");
    }

    public function scopeCodigo($query, $name)
    { //dd("noh");
        if($name)
            return $query->where('codigo','LIKE', "%$name%");
    }

    public function scopeAgrup($query, $name)
    { //dd("noh");
        if($name)
            return $query->where('nombrepuesto','LIKE', "%$name%");
    }



}
