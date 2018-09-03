<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\Unidad1;
use App\Puesto;
use App\Nivel;
use App\Organigrama;
use App\Nomenclador;
use App\Vincularpuesto;
use App\Puestosorganigrama;
use Illuminate\Http\Request;
use JavaScript;
//use Laracasts\Utilities\JavaScript;

class OrganigramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {                
        $puestos = Puesto::all();
        $unidades=Unidad::orderBy('id', 'ASC')->where('id','>',0)->get(); 
       
        return view('organigrama.index')->with('puestos',$puestos)
                            ->with('unidades',$unidades);
    }

    public function indexN()
    {                
        $puestos = Nomenclador::all();
        $unidades=Unidad1::orderBy('id', 'ASC')->where('id','>',0)->get(); 
       
        return view('organigrama.index')->with('puestos',$puestos)
                            ->with('unidades',$unidades);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('organigrama.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$pregunta = Organigrama::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('organigrama')->with('status', 'Exito!');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function showP(Request $request)
    {        
        $pregunta = Puestosorganigrama::query()->delete();
        $idpue=$request->pue;
        $puesto=Puesto::find($idpue);
        $iduni=$puesto->unidad_id;
        $puestos = Puesto::where('unidad_id','>=',$iduni)
            ->get();
        //dd($puestos);
        //hacer carga de puestos aux
        
        $vacio=1;
        $organ = Puestosorganigrama::create([
                    'nombre' => "-",   
                    'id_puesto' => $vacio,                   
                    'iddependencia' => $vacio,                    
                    'unidad_id' => $vacio,
                    'op_codigo' => $vacio,
                    'nivel_id' => $vacio,
                    'empleado' => $vacio
                ]);

        foreach ($puestos as $pue){
            $iddep=$pue->iddependencia;
            //dd($pue->unidad_id);
            $unidad=$pue->unidad_id;

            $puestodep=Puesto::find($iddep);
            
            $idunidep=$puestodep->unidad_id;
            //dd($idunidep);

          if($idunidep>=$iduni || $pue->id==$idpue){
            $idinsertado=$iddep;
            //iddep es 26
            
            //dd($pue->nombre);buscar vacios
            $i=$unidad-1;
            $uni=$i."";  
            $e="1";
            $u="0";

            if($i == $idunidep  || $i > $iduni){
                $idinsertado=Puestosorganigrama::buscarDep($idinsertado);
                // dd("entt");      
            }

            if($i > $idunidep){
               // dd("entro2");
                $organ = Puestosorganigrama::create([
                    'nombre' => "-",    
                    'id_puesto' => $e,                
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $u,
                    'op_codigo' => $e,
                    'nivel_id' => $e,
                    'empleado' => $e
                ]);
                $i=$i-1;
             
                $idinsertado=$organ->id;
            }

            while ( $i > $idunidep) {
                //dd("entro2");
                //dd($uni);
                $organ = Puestosorganigrama::create([
                    'nombre' => "-",   
                    'id_puesto' => $e,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $u,
                    'op_codigo' => $e,
                    'nivel_id' => $e,
                    'empleado' => $e
                ]);
                $i=$i-1;
             
                $idinsertado=$organ->id;
                //dd($iddep);
            }
            $organ = Puestosorganigrama::create([
                    'nombre' => $pue->nombre,   
                    'id_puesto' => $pue->id,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $pue->unidad_id,
                    'nivel_id' => $pue->nivel_id,
                    'op_codigo' => $pue->op_codigo,
                    'empleado' => $pue->empleado
                ]);
             $idinsertado=$organ->id;
            }
        }


        $puestosorg = Puestosorganigrama::all();
        //dd($puestosorg);
         $puestosorg = Puestosorganigrama::join('nivel', 'nivel.id', '=', 'puestosorganigrama.nivel_id')
            ->join('unidad', 'unidad.id', '=', 'puestosorganigrama.unidad_id')           
            ->select('puestosorganigrama.*','nivel.nombre as nivel_name','unidad.nombre as unidad_name')     
            ->get();

        return view('organigrama.verP',compact('puestosorg'));
    }

    public function showNomenclador(Request $request)
    {        
        $pregunta = Puestosorganigrama::query()->delete();
        $idpue=$request->pue;
        //dd($idpue);
        $iduni=Vincularpuesto::where('nomenclador_id',$idpue)->pluck('unidad_id');
        
        //dd($iduni);
        if(isset($iduni)){
            $iduni=Vincularpuesto::pluck('unidad_id')->first();
            //dd($iduni);
        }
        $puestos = Vincularpuesto::join('nomenclador', 'nomenclador.id', '=', 'vincularpuesto.nomenclador_id')               
            ->select('vincularpuesto.*','nomenclador.nombrepuesto as puesto_name', 'nomenclador.nivel_id as nivel_id')     
            ->orderBy('unidad_id', 'ASC')->
                        where('unidad_id','>=',$iduni)
                        ->get();
        //dd($puestos);
        /*$puestos = Vincularpuesto::orderBy('unidad_id', 'ASC')->
                        where('unidad_id','>=',$iduni)
                        ->get();*/
        /*$puestos = Unidad1::join($puests,'unidad1.id', '=', 'vincularpuesto.unidad_id')      
            ->select('vincularpuesto.*','unidad1.nombre as unidad_name')
            ->get();*/
        //dd($puestos);

        //hacer carga de puestos aux
        
        $vacio=0;

        foreach ($puestos as $pue){ //Vincularpuesto
            $iddep=$pue->iddependencia; //dep en la vista, first 1
            //dd($iddep);
            $unidad=$pue->unidad_id;  //2

            if($unidad==$iduni){
                 $organ = Puestosorganigrama::create([
                    'nombre' => "-",   
                    'id_puesto' => $iddep, 
                    'unidad_id' => $vacio,
                    'nivel_id' => $vacio,
                ]);
                 $idinsertado=$organ->id;
                 $organ1 = Puestosorganigrama::create([
                    'nombre' => $pue->puesto_name,   
                    'id_puesto' => $pue->nomenclador_id,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $pue->unidad_id,
                    //'op_codigo' => $vacio,
                    'nivel_id' => $pue->nivel_id,
                    //'empleado' => $vacio
                ]);

                $idinsertado=$organ1->id;
                //dd($organ1);
            }else{
//dd($iddep);
            $idunidepen=Puestosorganigrama::where('id_puesto',$iddep)
                            ->pluck('unidad_id');
            $iddepen=Puestosorganigrama::where('id_puesto',$iddep)
                            ->pluck('id');
            //dd($iddepen[0]);
            $idunidep=$idunidepen[0];
            
            //$i=$unidad+1;
            $i=$idunidep+1;
            $uni=$i."";  
            $e="1";
            $u="0";
            $nombre="-";
//dd($idunidep);
            if($i == $unidad){
                
                $organ = Puestosorganigrama::create([
                    'nombre' => $pue->puesto_name,   
                    'id_puesto' => $pue->nomenclador_id,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $pue->unidad_id,
                    //'op_codigo' => $vacio,
                    'nivel_id' => $pue->nivel_id,
                    //'empleado' => $vacio
                ]);
               //dd("entro2");
             
                $idinsertado=$organ->id;
            }else{
//dd($i);
            $organ = Puestosorganigrama::create([
                    'nombre' => $nombre,   
                    'id_puesto' => $u,                   
                    'iddependencia' => $iddepen[0],                    
                    'unidad_id' => $i,
                    'nivel_id' => $u,
                ]);
               //dd("entro2");
             $i=$i+1;
            $idinsertado=$organ->id;

            while ( $i < $unidad) {
               // dd($unidad);
                //dd($i);
                $organ = Puestosorganigrama::create([
                    'nombre' => $nombre,   
                    'id_puesto' => $u,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $i,
                    'nivel_id' => $u,
                ]);
                $i=$i+1;
             
                $idinsertado=$organ->id;
                //dd("$iddep");
            
            }//dd($iddep);

            $organ = Puestosorganigrama::create([
                    'nombre' => $pue->puesto_name,   
                    'id_puesto' => $pue->nomenclador_id,                   
                    'iddependencia' => $idinsertado,                    
                    'unidad_id' => $pue->unidad_id,
            
                    'nivel_id' => $pue->nivel_id,
             
                ]);
               //dd("entro24");
             
                $idinsertado=$organ->id;
        }
             }
        }

//dd("fin");
        $puestosorg = Puestosorganigrama::all();
        //dd($puestosorg);
        /* $puestosorg = Puestosorganigrama::join('nivel', 'nivel.id', '=', 'puestosorganigrama.nivel_id')
            ->join('unidad', 'unidad.id', '=', 'puestosorganigrama.unidad_id')           
            ->select('puestosorganigrama.*','nivel.nombre as nivel_name','unidad.nombre as unidad_name')     
            ->get();*/

        return view('organigrama.verP',compact('puestosorg'));
    }

    public function show(Request $request)
    {
        //dd("hola");
        $iduni=$request->uni;
        //dd($iduni);
       
        $puestos = Puesto::join('nivel', 'nivel.id', '=', 'puesto.nivel_id')
            ->join('unidad', 'unidad.id', '=', 'puesto.unidad_id')            
            ->select('puesto.*', 'nivel.nombre as nivel_name','unidad.nombre as unidad_name')
            ->where('unidad_id','>=',$iduni)
            ->get();
            
        //dd($puestos);

        //$iddep=$iddep->toArray();
        //dd($iddep);
        return view('organigrama.ver',compact('puestos'));
    }

    public function getDep(Request $request){
      
            $iduni=$request->iddependencia;
            //dd($iduni);
            $puesto=Puesto::puesto($iduni);
            $puestos=$puesto->iddependencia;
          
            return Response()->json($puestos); 
    }

    public function getDep1(Request $request){//borrar
      
            $iduni=$request->id;
            //dd($iduni);
            $puesto=Puesto::puestosdep($iduni);
            $puestos=$puesto->iddependencia;
            //dd($puestos);
            return Response()->json($puestos); 
    }

    public function getPue(Request $request){
      
            $idpue=$request->iddependencia;
            //dd($iduni);
            $puesto=Puesto::find($idpue);
            $puestos=$puesto->iddependencia;
            //dd($puestos);
            return Response()->json($puestos); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }
}
