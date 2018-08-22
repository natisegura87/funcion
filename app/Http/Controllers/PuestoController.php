<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Unidad;
use App\Nivel;
use App\Empleado;
use App\Op;
use App\Agrupamiento;
use Illuminate\Http\Request;

class PuestoController extends Controller
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
            

        $preguntas = Puesto::join('nivel', 'nivel.id', '=', 'puesto.nivel_id')
            ->join('nivel as nivel_com', 'nivel_com.id', '=', 'puesto.complejidad')
            ->join('nivel as nivel_res', 'nivel_res.id', '=', 'puesto.responsabilidad')
            ->join('nivel as nivel_aut', 'nivel_aut.id', '=', 'puesto.autonomia')
            ->join('unidad', 'unidad.id', '=', 'puesto.unidad_id')
            ->join('agrupamiento', 'agrupamiento.id', '=', 'puesto.agrupamiento_id')
            ->join('puesto as pu', 'pu.id', '=', 'puesto.iddependencia')
            ->join('op', 'op.codigo', '=', 'puesto.op_codigo')
            ->join('empleados', 'empleados.legajo', '=', 'puesto.empleado')
            ->select('puesto.*', 'nivel.nombre as nivel_name', 'agrupamiento.nombre as agrupamiento_name',
                'nivel_com.complejidad as nivel_complejidad','nivel_res.responsabilidad as nivel_responsabilidad','nivel_aut.autonomia as nivel_autonomia',
                'nivel.supervision as nivel_supervision','nivel.requisitos as nivel_requisitos','nivel.experiencia as nivel_experiencia',
                'unidad.nombre as unidad_name','pu.nombre as puesto_name','op.denominacion as op_name','empleados.APELLIDO_NOMBRE as ap_name')
            ->orderBy('puesto.id', 'DESC')
            ->paginate(5);

            //dd($preguntas);
        $niveles= Nivel::orderBy('nivel.id', 'DESC')
                    ->where('nivel.id','>','0')->get();

    return view('puesto.index', compact('preguntas','niveles'));

    }

    public function getPuesto(Request $request){
        //dd("hola");
            $id=$request->id;
            $puestos = Puesto::puesto($id);
            //dd($puestos);
            return Response()->json($puestos); 
    }

    public function getPuestos(Request $request){
        //dd("hola");
            $id=$request->id ;
            $puestos = Puesto::puestos($id);
            return Response()->json($puestos); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = Op::pluck('organismos','codigo'); 
        $agrupamiento= Agrupamiento::all();
        //dd($niveles);
        $unidades = Unidad::orderBy('id', 'ASC')
                         ->where('id','>',0)->get();  
        $empleados = Empleado::where('id','<>',0)
                        ->orderBy('APELLIDO_NOMBRE', 'ASC')
                        ->pluck('APELLIDO_NOMBRE','LEGAJO');
        //dd($empleados);
        return view('puesto.crear', compact('niveles','unidades','empleados','agrupamiento'));
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

         $nivel = "7";

        //Pregunta::create($request->all());
        $pregunta = Puesto::create([
            'nombre' => $request->nombre,
            'empleado' => $request->empleado,
            'unidad_id' => $request->uni,
            'agrupamiento_id' => $request->agrup, 
            'iddependencia' => $request->dep,
            'op_codigo' => $request->op,
            'nivel_id' => $nivel
        ]);
//->with('success','Registro creado satisfactoriamente');
        return redirect()->route('puestos.index')->with('status', 'Puesto creado satisfactoriamente');
    }

    public function preguntas(Request $request)
        {
            $pregunta = Puesto::create([
                'complejidad' => $request->complejidad,
                'responsabilidad' => $request->responsabilidad,
                'autonomia' => $request->autonomia, 
                'supervision' => $request->supervision,
                'requisitos' => $request->requisitos,
                'experiencia' => $request->experiencia
            ]);
  
            return redirect()->route('puestos.index')->with('status', 'Preguntas guardadas');
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
        $preguntas=Puesto::find($id);
        $niveles = Op::pluck('organismos','codigo'); 
        $agrupamiento= Agrupamiento::all();
        $empleados = Empleado::where('id','<>',0)
                        ->orderBy('APELLIDO_NOMBRE', 'ASC')
                        ->pluck('APELLIDO_NOMBRE','LEGAJO');       
        $unidades = Unidad::orderBy('id', 'ASC')
                           ->where('id','>',0)->get();     
        $uni=$preguntas->unidad_id;
        $puestos = Puesto::puestos($uni);     
        

        //$dep=Puesto::where('id',$preguntas->iddependencia)->pluck('nombre');
        //dd($dep);
        return  view('puesto.editar',compact('preguntas','niveles','unidades','empleados','puestos','agrupamiento'));
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
 
        $pregunta = Puesto::find($id);      
        $pregunta->nombre = $request->get('nombre'); 
        $pregunta->empleado = $request->get('empleado'); 
        $pregunta->unidad_id = $request->get('uni'); 
        $pregunta->agrupamiento_id = $request->get('agrup'); 
        $pregunta->iddependencia = $request->get('dep'); 
        $pregunta->op_codigo = $request->get('op'); 
        $pregunta->save();

        return redirect()->route('puestos.index')->with('status','Puesto actualizado');
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

        return redirect()->route('puestos.index')->with($status,$cartel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Puesto::find($id);
        $pregunta->delete();
        return redirect()->route('puestos.index')->with('status','Puesto eliminado satisfactoriamente');
    }
}
