<?php

namespace App\Http\Controllers;

use App\Ejemplo;
use App\Puesto;
use App\Nivel;
use App\Organigrama;
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
        $puestos = Puesto::join('nivel', 
            'nivel.id', '=', 'puesto.nivel_id')
            ->select('puesto.*', 'nivel.nombre as nivel_name')
            ->get();//->where('parent',1); 
        //dd($puestos);
        /*$plucked = $puestos
                        ->where('nivel',3)
                        ->pluck('nombre');

        $preguntas = Pregunta::join('nivel', 'nivel.id', '=', 'preguntas.nivel_id')
            ->select('preguntas.*', 'nivel.nombre as nivel_name')
            ->orderBy('preguntas.id', 'DESC')
            ->paginate(2);

        dd($plucked->first());*/
        //$r= Nivel::where('id',3)->get(); colection 
      

        //$nivel = Nivel::whereHas('posts')->pluck('id');      
       
        $puestos = $puestos->toJson();
       
        return view('mix.show')->with('puestos',$puestos);
    }
    public function getNivel(Request $request, $id)
    {
        if($request->ajax()){
            $nivel = Organigrama::nivel($id);
            //dd($nivel);
            return response()->json($nivel);
        }
        
        //dd($nivel);
        return view('mix.show')->with('nivel',$nivel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organigrama.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pregunta = Organigrama::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('organigrama')->with('status', 'Exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('organigrama.ver', ['organigrama' => Organigrama::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pregunta = Organigrama::findOrFail($id);

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
        $pregunta = Organigrama::findOrFail($id);

        $pregunta->nombre = $request->get('nombre');       

        $pregunta->save();

        //$url = action('PermissionController@show', ['id' => $permiso->id]);

        $request->session()->flash('status', 'Pregunta <a href="#">' . $pregunta->nombre . '</a> Actualizada');

        return redirect()->route("organigrama.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Organigrama::findOrFail($id);
        $pregunta->delete();
        
        $request->session()->flash('status', 'Borrado!');
    }
}
