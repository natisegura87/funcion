<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\Puesto;
use App\Nivel;
use App\Organigrama;
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
    
    public function index2()
    {
        $puestos = Puesto::join('nivel', 'nivel.id', '=', 'puesto.nivel_id')
            ->join('unidad', 'unidad.id', '=', 'puesto.unidad_id')
            ->join('puesto as pu', 'pu.id', '=', 'puesto.iddependencia')
            ->select('puesto.*', 'nivel.nombre as nivel_name','unidad.nombre as unidad_name','pu.nombre as puesto_name')     
            ->get();//->where('parent',1);          
       
        $puestos = $puestos->toJson();      
       
        return view('organigrama.ver2')->with('puestos',$puestos);           
    }

    public function index()
    {                
        $puestos = Puesto::all();
        $unidades=Unidad::orderBy('id', 'ASC')->get();
       
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
        
        //dd($iduni);
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
            //dd($iddep);
            $unidad=$pue->unidad_id;
            $puestodep=Puesto::find($iddep);
            
            $idunidep=$puestodep->unidad_id;
            $idinsertado=$iddep;
            //iddep es 26
            
            //dd($pue->nombre);buscar vacios
            $i=$unidad-1;
            $uni=$i."";  
            $e="1";
            $u="0";

            if($i == $idunidep  || $i > $idunidep){
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

        //$puestosorg = Puestosorganigrama::all();
         $puestosorg = Puestosorganigrama::join('nivel', 'nivel.id', '=', 'puestosorganigrama.nivel_id')
            ->join('unidad', 'unidad.id', '=', 'puestosorganigrama.unidad_id')           
            ->select('puestosorganigrama.*','nivel.nombre as nivel_name','unidad.nombre as unidad_name')     
            ->get();

        return view('organigrama.ver2',compact('puestosorg'));
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
        //dd("hola");
            $iduni=$request->iddependencia;
            //dd($iduni);
            $puesto=Puesto::puesto($iduni);
            $puestos=$puesto->iddependencia;
            //dd($puestos);
            return Response()->json($puestos); 
    }

    public function getPue(Request $request){
        //dd("hola");
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
       // $pregunta = Organigrama::findOrFail($id);

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
       /* $pregunta = Organigrama::findOrFail($id);

        $pregunta->nombre = $request->get('nombre');       

        $pregunta->save();

        //$url = action('PermissionController@show', ['id' => $permiso->id]);

        $request->session()->flash('status', 'Pregunta <a href="#">' . $pregunta->nombre . '</a> Actualizada');

        return redirect()->route("organigrama.index");*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       /* $pregunta = Organigrama::findOrFail($id);
        $pregunta->delete();
        
        $request->session()->flash('status', 'Borrado!');*/
    }
}
