<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Unidad;
use App\Nivel;
use App\Empleado;
use App\Op;
use App\Nomenclador;
use App\Agrupamiento;
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
            

        $preguntas = Nomenclador::join('nivel', 'nivel.id', '=', 'nomenclador.nivel_id')
            ->join('nivel as nivel_com', 'nivel_com.id', '=', 'nomenclador.complejidad')
            ->join('nivel as nivel_res', 'nivel_res.id', '=', 'nomenclador.responsabilidad')
            ->join('nivel as nivel_aut', 'nivel_aut.id', '=', 'nomenclador.autonomia')
            ->join('agrupamiento', 'agrupamiento.id', '=', 'nomenclador.agrupamiento_id')
          
            ->select('nomenclador.*', 'nivel.nombre as nivel_name', 'agrupamiento.nombre as agrupamiento_name',
                'nivel_com.complejidad as nivel_complejidad','nivel_res.responsabilidad as nivel_responsabilidad','nivel_aut.autonomia as nivel_autonomia',
                'nivel.supervision as nivel_supervision','nivel.requisitos as nivel_requisitos','nivel.experiencia as nivel_experiencia')
            ->orderBy('nomenclador.id', 'DESC')
            ->paginate(5);

            //dd($preguntas);
        $niveles= Nivel::orderBy('nivel.id', 'DESC')
                    ->where('nivel.id','>','0')->get();

    return view('nomenclador.index', compact('preguntas','niveles'));

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
        //dd($niveles);
        $unidades = Unidad::orderBy('id', 'ASC')
                         ->where('id','>',0)->get();  
        $empleados = Empleado::where('id','<>',0)
                        ->orderBy('APELLIDO_NOMBRE', 'ASC')
                        ->pluck('APELLIDO_NOMBRE','LEGAJO');
        //dd($empleados);
        return view('nomenclador.crear', compact('niveles','unidades','empleados','agrupamiento'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'nombre'=>'required'    
          //'nombre'=>'required|string|unique:preguntas'          
        ]);

         $nivel = "0";

        //Pregunta::create($request->all());
        $pregunta = Nomenclador::create([
            'nombre' => $request->nombre,
            'empleado' => $request->empleado,
            'unidad_id' => $request->uni,
            'agrupamiento_id' => $request->agrup, 
            'iddependencia' => $request->dep,
            'op_codigo' => $request->op,
            'nivel_id' => $nivel
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
        $niveles = Op::pluck('organismos','codigo'); 
        $agrupamiento= Agrupamiento::all();
        $empleados = Empleado::where('id','<>',0)
                        ->orderBy('APELLIDO_NOMBRE', 'ASC')
                        ->pluck('APELLIDO_NOMBRE','LEGAJO');       
        $unidades = Unidad::orderBy('id', 'ASC')
                           ->where('id','>',0)->get();     
        $uni=$preguntas->unidad_id;
        $puestos = Nomenclador::puestos($uni);     
        

        //$dep=Puesto::where('id',$preguntas->iddependencia)->pluck('nombre');
        //dd($dep);
        return  view('nomenclador.editar',compact('preguntas','niveles','unidades','empleados','puestos','agrupamiento'));
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
        $this->validate($request,[ 
            'nombre'=>'required'            
        ]);       
 
        $pregunta = Nomenclador::find($id);      
        $pregunta->nombre = $request->get('nombre'); 
        $pregunta->empleado = $request->get('empleado'); 
        $pregunta->unidad_id = $request->get('uni'); 
        $pregunta->agrupamiento_id = $request->get('agrup'); 
        $pregunta->iddependencia = $request->get('dep'); 
        $pregunta->op_codigo = $request->get('op'); 
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
        return redirect()->route('nomenclador.index')->with('status','Puesto eliminado satisfactoriamente');
    }
}
