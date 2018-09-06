<?php

namespace App\Http\Controllers;
use App\Nomencladorfuncionarios;
use Illuminate\Http\Request;

class NomencladorfuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $preguntas = Nomencladorfuncionarios::orderBy('nomencladorfuncionarios.nombrepuesto', 'ASC')
            ->paginate(5);
    //dd($preguntas);
    return view('nomencladorfuncionarios.index', compact('preguntas'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nomencladorfuncionarios.crear');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                   
        $pregunta = Nomencladorfuncionarios::create([
            'nombrepuesto' => $request->nombre,            
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('nomencladorfuncionarios.index')->with('status', 'Puesto creado satisfactoriamente');
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
        $preguntas=Nomencladorfuncionarios::find($id);
        
        $uni=$preguntas->unidad_id;
        //$puestos = Nomencladorfuncionarios::puestos($uni);     
        

        //$dep=Puesto::where('id',$preguntas->iddependencia)->pluck('nombre');
        //dd($dep);
        return  view('nomencladorfuncionarios.editar',compact('preguntas'));
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
 
        $pregunta = Nomencladorfuncionarios::find($id);      
        $pregunta->nombrepuesto = $request->get('nombre'); 
        $pregunta->descripcion = $request->get('descripcion'); 
      
        $pregunta->save();

        return redirect()->route('nomencladorfuncionarios.index')->with('status','Puesto actualizado');
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Nomencladorfuncionarios::find($id);
        $pregunta->delete();
        return redirect()->route('nomencladorfuncionarios.index')->with('status','Puesto funcionario eliminado');
    }
}
