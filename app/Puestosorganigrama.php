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

}
