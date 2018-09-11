<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nivel;

class Puestosorganigrama extends Model
{
    protected $table = 'puestosorganigrama';

    protected $fillable = [
        'id',
        'nombre',
        'id_puesto',
        'iddependencia',
        'unidad_id',
        'nivel_id',
        'empleado',
        'op_codigo'
        
    ];

    public static function buscarDep($idDep)
    {        
        $res=Puestosorganigrama::where('id_puesto',$idDep)->get();
        $resultado = ($res->isEmpty()) ? $idDep : $res[0]->id;
        return  $resultado;
                    
    }

    public static function buscarDep1($idDep)
    {        
        $res=Puestosorganigrama::where('id_puesto',$idDep)->get();
        $resultado = ($res->isEmpty()) ? $idDep : $res[0]->iddependencia;
        return  $resultado;
                    
    }

    public static function get1($idDep) // borrar
    {
        $id=0;
    $res=Puestosorganigrama::where('id_puesto',$idDep)->get();
        $resultado = ($res->isEmpty()) ? $id : $res[0]->unidad_id;
        return  $resultado;
   
}

}
