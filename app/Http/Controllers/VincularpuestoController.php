<?php

namespace App\Http\Controllers;

use App\Vincularpuesto;
use App\Unidad1;
use App\Nomenclador;
use App\Localidad;
use App\Op;
use App\Regimen;
use Illuminate\Http\Request;

class VincularpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Vincularpuesto::join('unidad1', 'unidad1.id', '=', 'vincularpuesto.unidad_id')
            ->join('localidad', 'localidad.id', '=', 'vincularpuesto.localidad_id')
            ->join('op', 'op.codigo', '=', 'vincularpuesto.op_id')
            ->join('nomenclador as puest', 'puest.id', '=', 'vincularpuesto.nomenclador_id')
            ->join('nomenclador as dep', 'dep.id', '=', 'vincularpuesto.iddependencia')
           
            ->select('vincularpuesto.*', 'dep.nombrepuesto as dependencia_name', 
                'unidad1.nombre as unidad_name','puest.nombrepuesto as puesto_name',
                'localidad.nombre as localidad_name', 'op.denominacion as op_name')
            ->orderBy('vincularpuesto.id', 'DESC')
            ->paginate(5);

    return view('vincularpuesto.index', compact('preguntas'));

    }

    public function getPuestoDep(Request $request){
   
        $id=$request->id;  
        $organismo=$request->organismo;    
        $todos="0";

         $preguntas = Vincularpuesto::join('nomenclador', 'nomenclador.id', '=', 'vincularpuesto.nomenclador_id')           
           
            ->select('vincularpuesto.*', 'nomenclador.nombrepuesto as puesto_name')
            ->orderBy('puesto_name', 'ASC')
            ->where('vincularpuesto.unidad_id','<',$id)
       
            ->where('vincularpuesto.op_id','=',$organismo)
            ->orwhere('vincularpuesto.op_id','=',$todos)
            ->where('nomenclador.genteacargo','on')->get();

       // dd($preguntas);         
        

        //$funcionarios = Puestofuncionarios::pluck('nombrepuesto','id');        
        //$pue = Nomenclador::where('genteacargo','on')->get(); 
        //$puestos =$pue->pluck('nombrepuesto','id');
        //$dependencia= $funcionarios->concat($puestos);
        //dd($puestos);
        return Response()->json($preguntas); 
    }

    public function getPuestoOrg(Request $request){   
       
        $organismo=$request->organismo;   
        $regimen=$request->regimen;  
        //dd($cond);//1 7 2

        $puestos = Nomenclador::where('regimen_id',$regimen)
                            ->get();       

        $arrayOrg = array();
        foreach($puestos as $pue) {
            
            $org=$pue->organismos;

            $orga=explode(" ",$org);
            foreach($orga as $id=>$val) {
                //dd($val); 
                if($val==$organismo || $val=="0"){
                    $arrayOrg[] = $pue; 
                } 
            }
         }  
    //dd($arrayOrg);
    return Response()->json($arrayOrg); 
    }

    public function getPuestos(Request $request){

        $organismo=$request->organismo;   
        $regimen=$request->regimen; 
       // dd($organismo);

        $puestos = Nomenclador::where('regimen_id',$regimen)
                            ->get();       

        $arrayOrg = array();
        foreach($puestos as $pue) {
            
            $org=$pue->organismos;

            $orga=explode(" ",$org);
            foreach($orga as $id=>$val) {
                //dd($val); 
                if($val==$organismo || $val=="0"){
                    $arrayOrg[] = $pue; 
                } 
            }
         }  

            //dd($puestos);
        return Response()->json($arrayOrg); 
    }

    public function getUnidad(Request $request){
     
            $id=$request->id;
            $organismo=$request->organismo; 
            $unidades = Unidad1::orderBy('id', 'ASC')
                        ->where('parafuncionario',$id)->get();
            return Response()->json($unidades); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regimenF=Regimen::where('id',1)->get();
        $regimenL=Regimen::where('id',10)->get();
        $regimen= $regimenF->concat($regimenL);
                                   
        $unidades = Unidad1::orderBy('id', 'ASC')
                         ->where('id','>',0)->get();

        $organismos = Op::all();   
        $localidad=Localidad::all();  
        //dd($regimen);  

        $puestos = Vincularpuesto::join('nomenclador', 'nomenclador.id', '=', 'vincularpuesto.nomenclador_id')      
            ->select('vincularpuesto.*', 'nomenclador.nombrepuesto as puesto_name')
            ->orderBy('puesto_name', 'ASC')                
            ->where('nomenclador.genteacargo','on')->get();
       
        return view('vincularpuesto.crear', compact('regimen','organismos','localidad'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pregunta = Vincularpuesto::create([           
            'nomenclador_id' => $request->puesto,
            'unidad_id' => $request->uni,            
            'iddependencia' => $request->dep,
            'localidad_id' => $request->localidad,
            'regimen_id' => $request->regimen,
            'op_id' => $request->organismo, 
            'generavacante' => $request->vacante
            
        ]);

        return redirect()->route('vincularpuesto.index')->with('status', 'Vinculo creado satisfactoriamente');
    }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preguntas=Vincularpuesto::find($id);

        $preguntas = Vincularpuesto::join('unidad1', 'unidad1.id', '=', 'vincularpuesto.unidad_id')
            ->join('localidad', 'localidad.id', '=', 'vincularpuesto.localidad_id')
            ->join('op', 'op.codigo', '=', 'vincularpuesto.op_id')
           
            ->join('nomenclador as puest', 'puest.id', '=', 'vincularpuesto.nomenclador_id')
            ->join('nomenclador as dep', 'dep.id', '=', 'vincularpuesto.iddependencia')
           
            ->select('vincularpuesto.*', 'dep.nombrepuesto as dependencia_name', 
                'unidad1.nombre as unidad_name','puest.nombrepuesto as puesto_name',
                'op.denominacion as op_name',
                'localidad.nombre as localidad_name', 'op.denominacion as op_name')
            ->where('puest.genteacargo','on')->get();



        $regimenF=Regimen::where('id',1)->get();
        $regimenL=Regimen::where('id',10)->get();
        $regimen= $regimenF->concat($regimenL);
                                   
       
        $organismo = Op::pluck('organismos','codigo'); 
        $localidad= Localidad::all();
             
        $unidades = Unidad1::orderBy('id', 'ASC')
                           ->where('id','>',0)->get();     
        //$uni=$preguntas->unidad_id;
        //$puestos = Vincularpuesto::puestos($uni);     
        $puestos = Vincularpuesto::all();
        //dd("llego");

        return  view('vincularpuesto.editar',compact('preguntas','organismo','unidades','empleados','puestos','localidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {             
 dd("f");
        $pregunta = Vincularpuesto::find($id);      
        $pregunta->nombre = $request->get('nombre'); 
        $pregunta->empleado = $request->get('empleado'); 
        $pregunta->unidad_id = $request->get('uni'); 
        $pregunta->agrupamiento_id = $request->get('agrup'); 
        $pregunta->iddependencia = $request->get('dep'); 
        $pregunta->op_codigo = $request->get('op'); 
        $pregunta->save();

        return redirect()->route('vincularpuesto.index')->with('status','Puesto actualizado');
    }

    public function updatePreg(Request $request)
    {           
        $id = $request->get('guardar');    
        $pregunta = Puesto::find($id);    
        $comple= $request->get('complejidad');         
        $respo= $request->get('responsabilidad'); 
        $auto= $request->get('autonomia');
        $falta=0;
        if($comple==$respo){
            $falta=$auto;
            $ant=$comple-1;
            $sig=$comple+1;
        }else if($comple==$auto){
            $falta=$respo;
            $ant=$comple-1;
            $sig=$comple+1;
        }else if($respo==$auto){
            $falta=$comple;
            $ant=$respo-1;
            $sig=$respo+1;
        }

        if($falta>0){ // dos iguales
            if($falta>=$ant && $falta<=$sig){
                $pregunta->complejidad = $request->get('complejidad'); 
                $pregunta->responsabilidad = $request->get('responsabilidad'); 
                $pregunta->autonomia = $request->get('autonomia'); 

                $calculo=$comple+$respo+$auto;
                $nivel=ceil($calculo/3);
                $nivelid=intval($nivel);
                //dd($nivelid);
                $pregunta->nivel_id = $nivelid; 
                $pregunta->save();
                $status='status';
                $cartel='Preguntas guardadas. '. $pregunta->nombre;
            }
            else{ // no hay uno de dif
                $status='error';
                $cartel='Inconsistencia entre niveles, hay más de un nivel de diferencia. '. $pregunta->nombre;
            }
            
        }else{ // todos distintos
            $status='error';
            $cartel='Inconsistencia, niveles diferentes. ' . $pregunta->nombre;
        }

        return redirect()->route('vincularpuesto.index')->with($status,$cartel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $pregunta = Vincularpuesto::find($id);
        $nomenclador=$pregunta->nomenclador_id;
        $hay= Vincularpuesto::where('iddependencia',$nomenclador)->first();
        //dd(isset($hay));
        if(isset($hay)){
            return redirect()->route('vincularpuesto.index')->with('error','No se puede eliminar el puesto.');
           
        }else{
            $pregunta->delete();
            return redirect()->route('vincularpuesto.index')->with('status','Puesto eliminado.');
         }
    }
}
