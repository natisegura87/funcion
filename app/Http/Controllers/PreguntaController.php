<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\Nivel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
     
        $preguntas = Pregunta::join('nivel', 'nivel.id', '=', 'preguntas.nivel_id')
            ->select('preguntas.*', 'nivel.nombre as nivel_name')
            ->orderBy('preguntas.id', 'DESC')
            ->paginate(2);

        return view('pregunta.index', compact('preguntas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = Nivel::all();
        return view('pregunta.crear', compact('niveles'));
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

        //Pregunta::create($request->all());
        $pregunta = Pregunta::create([
            'nombre' => $request->nombre,
            'nivel_id' => $request->niv,
            'respuesta' => $request->respuesta
        ]);
//->with('success','Registro creado satisfactoriamente');
        return redirect()->route('preguntas.index')->with('status', 'Exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preguntas=Pregunta::find($id);
        return  view('pregunta.ver',compact('preguntas'));
         //return view('pregunta.ver', ['pregunta' => Pregunta::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveles = Nivel::all();

        //$pregunta = Pregunta::findOrFail($id);
        $preguntas=Pregunta::find($id);
        /*->join('nivel', 'nivel.id', '=', 'preguntas.nivel_id')
            ->select('preguntas.*', 'nivel.nombre as nivel_name')
            ->get();*/
          //  dd($preguntas);
        return  view('pregunta.editar',compact('preguntas','niveles'));
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
        /*$pregunta = Pregunta::findOrFail($id);
        $pregunta->nombre = $request->get('nombre'); 
        $pregunta->save();
        //$url = action('PermissionController@show', ['id' => $permiso->id]);
        $request->session()->flash('status', 'Pregunta <a href="#">' . $pregunta->nombre . '</a> Actualizada');
        return redirect()->route("pregunta.index");*/

        $this->validate($request,[ 
            'nombre'=>'required'            
        ]);       
 
        $pregunta = Pregunta::find($id);      
        $pregunta->nombre = $request->get('nombre'); 
        $pregunta->nivel_id = $request->get('niv'); 
        $pregunta->respuesta = $request->get('respuesta'); 
        $pregunta->save();

       // ->update($request->all());

        //->with('success','Registro creado satisfactoriamente');
       // return redirect()->route('preguntas')->with('status', 'Exito!');

        return redirect()->route('preguntas.index')->with('status','Pregunta actualizada satisfactoriamente');
 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Pregunta::find($id);
        $pregunta->delete();

        //Pregunta::destroy($id);
        
        //$request->session()->flash('status', 'Borrado!');

        //Pregunta::find($id)->delete();
        return redirect()->route('preguntas.index')->with('status','Registro eliminado satisfactoriamente');

    }
}
