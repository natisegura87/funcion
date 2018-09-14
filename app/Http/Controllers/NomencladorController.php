<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Unidad;
use App\Nivel;
use App\Empleado;
use App\Op;
use App\Nomenclador;
use App\Agrupamiento;
use App\Subagrupamiento;
use App\Clasificacion;
use App\Subclasificacion;
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
    public function index(Request $request)
    {

        $codigo=$request->codigo;
        $name=$request->nombre;
        $agrupamiento=$request->agrupamiento;

       // $preguntas = Puesto::join('unidad', 'unidad.id', '=', 'preguntas.unidad_id')
           // ->select('preguntas.*', 'unidad.nombre as unidad_name')
            
//explode(" ",$str)
        $str=Nomenclador::pluck('condiciones')->last();

        $cond=explode("-",$str);
        //dd($cond);

        $preguntas = Nomenclador::join('nivel', 'nivel.id', '=', 'nomenclador.nivel_id')
            ->join('nivel as nivel_com', 'nivel_com.id', '=', 'nomenclador.complejidad')
            ->join('nivel as nivel_res', 'nivel_res.id', '=', 'nomenclador.responsabilidad')
            ->join('nivel as nivel_aut', 'nivel_aut.id', '=', 'nomenclador.autonomia')
            ->join('agrupamiento', 'agrupamiento.id', '=', 'nomenclador.agrupamiento_id')
            ->join('subagrupamiento', 'subagrupamiento.id', '=', 'nomenclador.subagrupamiento_id')
            ->join('clasificacion', 'clasificacion.id', '=', 'nomenclador.clasificacion_id')
            ->join('subclasificacion', 'subclasificacion.id', '=', 'nomenclador.subclasificacion_id')             
            ->select('nomenclador.*', 'nivel.nombre as nivel_name', 'agrupamiento.nombre as agrupamiento_name', 'subagrupamiento.nombre as subagrupamiento_name',
                'nivel_com.complejidad as nivel_complejidad','nivel_res.responsabilidad as nivel_responsabilidad','nivel_aut.autonomia as nivel_autonomia',
                'nivel.supervision as nivel_supervision','nivel.requisitos as nivel_requisitos','nivel.experiencia as nivel_experiencia','nivel.requisitos as nivel_requisitos'
            ,'clasificacion.nombre as clasificacion_name','subclasificacion.nombre as subclasificacion_name')
            ->orderBy('nomenclador.id', 'DESC')
            ->where('regimen_id',10)
            ->where('agrupamiento.nombre','LIKE', "%$agrupamiento%")
            ->codigo($codigo)
            ->nombre($name)
            ->paginate(5);

        

        //dd($preguntas);
        $niveles= Nivel::orderBy('nivel.id', 'DESC')
                    ->where('nivel.id','>','0')->get();

        $agrupamiento=Agrupamiento::select('nombre')->distinct()->get();
        $condiciones=Condiciones::all();

    return view('nomenclador.index', compact('preguntas','niveles','agrupamiento','condiciones'));

    }

    public function indexF()
    {
    $preguntas = Nomenclador::join('op','op.codigo', '=', 'nomenclador.organismos')
                    ->select('nomenclador.*', 'op.denominacion as op_name')
                    ->orderBy('nomenclador.id', 'DESC')
                    ->where('regimen_id',1)
                    ->paginate(3);
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
        $clasificacion= Clasificacion::all();
        $condiciones= Condiciones::all();
        $excluyentes=Excluyentes::all();
        $organismos= Op::all();
        //dd($niveles);
        return view('nomenclador.crear', compact('niveles','condiciones','excluyentes','agrupamiento','organismos','clasificacion'));
    }
    public function createF()
    {
        
        $organismo=Op::pluck('organismos','codigo'); 
        return  view('nomencladorfuncionarios.crear',compact('organismo'));
        
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
        $gente="on";
        $uno=1;

        $pregunta = Nomenclador::create([
            'codigo' => $nada,
            'nombrepuesto' => $request->nombre,            
            'descripcion' => $request->descripcion,
            'organismos' => $request->organismo,
            'complejidad' => $nada,
            'responsabilidad' => $nada,
            'autonomia' => $nada,
            'nivel_id' => $nada,
            'regimen_id' => 1,
            'agrupamiento_id' => $uno,
            'subagrupamiento_id' => $nada,
            'clasificacion_id' => $nada,
            'subclasificacion_id' => $nada,         
            'genteacargo' => $gente,           
            'condiciones' => $uno,
            'organismos' => $nada

        ]);

        return redirect()->route('nomencladorfuncionarios.index')->with('status', 'Puesto funcionario creado satisfactoriamente');
    }
    public function editF($id)
    {
        $preguntas=Nomenclador::find($id);    
        $organismo=Op::pluck('organismos','codigo'); 
        return  view('nomencladorfuncionarios.editar',compact('preguntas','organismo'));
    }
    public function updateF(Request $request, $id)
    {             
 
        $pregunta = Nomenclador::find($id);      
        $pregunta->nombrepuesto = $request->get('nombre'); 
        $pregunta->descripcion = $request->get('descripcion'); 
        $pregunta->organismos = $request->get('organismo'); 
      
        $pregunta->save();

        return redirect()->route('nomencladorfuncionarios.index')->with('status','Puesto funcionario actualizado');
    }
    public function destroyF(Request $request, $id)
    {
        $pregunta = Nomenclador::find($id);
        $pregunta->delete();
        return redirect()->route('nomencladorfuncionarios.index')->with('status','Puesto funcionario eliminado');
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
        $todos="TODOS"; 
        $con1=$request->condicion1;
        $arrayOP = array();
        if($con1 == $todos)
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
            'codigo' => $request->codigo,
            'nombrepuesto' => $request->nombre,
            'complejidad' => $request->complejidad,
            'responsabilidad' => $request->responsabilidad,
            'autonomia' => $request->autonomia,
            'regimen_id' => 10,
            'agrupamiento_id' => $request->agrupamiento,
            'subagrupamiento_id' => $request->subagrupamiento,
            'clasificacion_id' => $request->clasificacion,
            'subclasificacion_id' => $request->subclasificacion, 
            'descripcion' => $request->descripcion,
            'genteacargo' => $request->gente,
            'nivel_id' => $request->nivel,
            'condiciones' => $condiciones,
            'organismos' => $request->org
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
        $pregunta->codigo = $request->get('codigo'); 
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

    public function getSubagrupamientos(Request $request){
        //dd("hola");
            $id=$request->agrupamiento;             
            $puestos = Subagrupamiento::where('agrupamiento_id',$id)->get(); 
            //dd($puestos);
            return Response()->json($puestos); 
    }

    public function getSubclasificacion(Request $request){
        //dd("hola");
            $id=$request->clasificacion;             
            $puestos = Subclasificacion::where('clasificacion_id',$id)->get(); 
            //dd($puestos);
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
