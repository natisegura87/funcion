<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Unidad;
use App\Nivel;
use App\Empleado;
use App\Op;
use App\Nomenclador;
use App\Agrupamiento;
use App\Condiciones;
use App\Excluyentes;
use Illuminate\Http\Request;

class NomencladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // $preguntas = Puesto::join('unidad', 'unidad.id', '=', 'preguntas.unidad_id')
           // ->select('preguntas.*', 'unidad.nombre as unidad_name')
            
//explode(" ",$str)

        $preguntas = Nomenclador::join('nivel', 'nivel.id', '=', 'nomenclador.nivel_id')
            ->join('nivel as nivel_com', 'nivel_com.id', '=', 'nomenclador.complejidad')
            ->join('nivel as nivel_res', 'nivel_res.id', '=', 'nomenclador.responsabilidad')
            ->join('nivel as nivel_aut', 'nivel_aut.id', '=', 'nomenclador.autonomia')
            ->join('agrupamiento', 'agrupamiento.id', '=', 'nomenclador.agrupamiento_id')             
          
            ->select('nomenclador.*', 'nivel.nombre as nivel_name', 'agrupamiento.nombre as agrupamiento_name',
                'nivel_com.complejidad as nivel_complejidad','nivel_res.responsabilidad as nivel_responsabilidad','nivel_aut.autonomia as nivel_autonomia',
                'nivel.supervision as nivel_supervision','nivel.requisitos as nivel_requisitos','nivel.experiencia as nivel_experiencia')
            ->orderBy('nomenclador.id', 'DESC')
            ->where('regimen_id',10)
            ->paginate(5);

            //dd($preguntas);
        $niveles= Nivel::orderBy('nivel.id', 'DESC')
                    ->where('nivel.id','>','0')->get();

    return view('nomenclador.index', compact('preguntas','niveles'));

    }

    public function indexF()
    {
    $preguntas = Nomenclador::orderBy('nomenclador.nombrepuesto', 'ASC')
                    ->where('regimen_id',1)
                    ->paginate(5);
    //dd($preguntas);
    return view('nomencladorfuncionarios.index', compact('preguntas'));

    }

    public function getPuesto(Request $request){
        //dd("hola");
            $id=$request->id;
            $puestos = Nomenclador::puesto($id);
            //dd($puestos);
            return Response()->json($puestos); 
    }

    public function getPuestos(Request $request){
        //dd("hola");
           // $id=$request->id ;
            $puestos = Nomenclador::all();
            return Response()->json($puestos); 
    }

    public function getPuestosDep(Request $request){
        //dd("hola");
            $id=$request->id ;
            $puestos = Nomenclador::puestos($id);
            return Response()->json($puestos); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = Nivel::orderBy('id', 'DESC')
                         ->where('id','>',0)->get(); 
        $agrupamiento= Agrupamiento::all();
        $condiciones= Condiciones::all();
        $excluyentes=Excluyentes::all();
        $organismos= Op::all();
        //dd($niveles);
        return view('nomenclador.crear', compact('niveles','condiciones','excluyentes','agrupamiento','organismos'));
    }
    public function createF()
    {
        return view('nomencladorfuncionarios.crear');
    }

      public function createR()
    {
        $niveles = Op::pluck('organismos','codigo'); 
        $agrupamiento= Agrupamiento::all();
        //dd($niveles);
        $unidades = Unidad::orderBy('id', 'ASC')
                        ->where('id','>',0)->get();  
        $empleados = Empleado::where('id','<>',0)
                        ->orderBy('APELLIDO_NOMBRE', 'ASC')
                        ->pluck('APELLIDO_NOMBRE','LEGAJO');
        //dd("createR");
        return view('respuesta.crear', compact('niveles','unidades','empleados','agrupamiento'));
    }

    public function storeF(Request $request)
    {           
        $nada=0;

        $pregunta = Nomenclador::create([
            'nombrepuesto' => $request->nombre,            
            'descripcion' => $request->descripcion,
            'complejidad' => $nada,
            'responsabilidad' => $nada,
            'autonomia' => $nada,
            'nivel_id' => $nada,
            'regimen_id' => 1,
        ]);

        return redirect()->route('nomencladorfuncionarios.index')->with('status', 'Puesto creado satisfactoriamente');
    }
    public function editF($id)
    {
        $preguntas=Nomenclador::find($id);    
        return  view('nomencladorfuncionarios.editar',compact('preguntas'));
    }
    public function updateF(Request $request, $id)
    {             
 
        $pregunta = Nomenclador::find($id);      
        $pregunta->nombrepuesto = $request->get('nombrepuesto'); 
        $pregunta->descripcion = $request->get('descripcion'); 
      
        $pregunta->save();

        return redirect()->route('nomencladorfuncionarios.index')->with('status','Puesto actualizado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {            
        $condiciones="";   
        $nada="Ninguno";   
        $nada="TODOS"; 
        $con1=$request->condicion1;
        $arrayOP = array();
        if($con1 == $nada)
            $arrayOP[] = $todos;
        else
            $arrayOP[] = $con1;
        //dd($arrayOP);


        $con2=$request->condicion2;
        $con3=$request->condicion3;
        $con4=$request->condicion4;
        $con5=$request->condicion5;
        $con6=$request->condicion6;

        $array = array();
        
        if($con2 > 0)
            $array[] = $con2;
        if($con3 > 0)
            $array[] = $con3;
        if($con4 > 0)
            $array[] = $con4;
        if($con5 > 0)
            $array[] = $con5;
        if($con6 > 0)
            $array[] = $con6;
        if(empty($array)){
            $array[] = $nada;
        }
        
        $condiciones=implode("-",$array);
        $organ=implode("-",$arrayOP);
           
        //dd($organ); 
       
        $pregunta = Nomenclador::create([
            'nombrepuesto' => $request->nombre,
            'complejidad' => $request->complejidad,
            'responsabilidad' => $request->responsabilidad,
            'autonomia' => $request->autonomia,
            'regimen_id' => 10,
            'agrupamiento_id' => $request->agrupamiento, 
            'descripcion' => $request->descripcion,
            'genteacargo' => $request->gente,
            'nivel_id' => $request->nivel,
            'condiciones' => $condiciones,
            'organismos' => $organ
        ]);
//->with('success','Registro creado satisfactoriamente');
        return redirect()->route('nomenclador.index')->with('status', 'Puesto creado satisfactoriamente');
    }

    public function preguntas(Request $request)
        {
            $pregunta = Nomenclador::create([
                'complejidad' => $request->complejidad,
                'responsabilidad' => $request->responsabilidad,
                'autonomia' => $request->autonomia, 
                'supervision' => $request->supervision,
                'requisitos' => $request->requisitos,
                'experiencia' => $request->experiencia
            ]);
  
            return redirect()->route('nomenclador.index')->with('status', 'Preguntas guardadas');
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
        $preguntas=Nomenclador::find($id);
        
        return  view('nomenclador.editar',compact('preguntas'));
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
        $pregunta = Nomenclador::find($id);      
        $pregunta->nombrepuesto = $request->get('nombre');
        $pregunta->descripcion = $request->get('descripcion'); 
        $pregunta->save();

        return redirect()->route('nomenclador.index')->with('status','Puesto actualizado');
    }

    public function updatePreg(Request $request)
    {           
        $id = $request->get('guardar');    
        $pregunta = Nomenclador::find($id);    
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

        return redirect()->route('nomenclador.index')->with($status,$cartel);
    }
public function getAgrupamientos(Request $request){
        //dd("hola");
            $id=$request->nivel;             
            $puestos = Agrupamiento::where('nivel_id',$id)->get(); 
            return Response()->json($puestos); 
    }

    public function nivelPreg(Request $request)
    {        
           
        $comple= $request->complejidad;         
        $respo= $request->responsabilidad;
        $auto= $request->autonomia;
          
        $falta=0;
        $nivelid=0;
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
                $calculo=$comple+$respo+$auto;
                $nivel=ceil($calculo/3);
                $nivelid=intval($nivel);
                //dd($nivelid);               
                $status='status';
                $cartel='Nivel guardado. ';
            }
            else{ // no hay uno de dif
                $status='error';
                $cartel='Inconsistencia entre niveles, hay más de un nivel de diferencia. ';
            }
            
        }else{ // todos distintos
            $status='error';
            $cartel='Inconsistencia, niveles diferentes. ';
        }
      
        $nivel = Nivel::find($nivelid);
        //dd($nivel);
        return Response()->json($nivel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Nomenclador::find($id);
        $pregunta->delete();
        return redirect()->route('nomenclador.index')->with('status','Puesto del nomenclador eliminado');
    }
}
