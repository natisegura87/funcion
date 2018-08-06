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
        /*$preguntas = Pregunta::orderBy('id','DESC')->paginate(2);
         $niveles = Nivel::all();

        $users = User::join('departaments', 'departaments.id', '=', 'users.departament_id')
            ->select('users.*', 'departaments.name as departament_name')
            ->orderBy('users.id', 'DESC')
            ->paginate();*/

            $preguntas = Pregunta::join('nivel', 'nivel.id', '=', 'preguntas.nivel_id')
            ->select('preguntas.*', 'nivel.nombre as nivel_name')
            ->orderBy('preguntas.id', 'DESC')
            ->paginate(2);

        //$preguntas = Pregunta::lists('id','nombre');
        //User::where('votes', '>', 100)->paginate(15); 
        //$users = DB::table('users')->simplePaginate(15);
        //->where('idPadre',2); para buscar los hijos
        //$unidad = Unidad::orderBy('orden','ASC')->get();
    //return view('pregunta.index')
        //->with('preguntas',Pregunta::all());
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
          //'nombre'=>'required|string|unique:preguntas'          
        ]);

        $pregunta = Pregunta::create([
            'nombre' => $request->nombre,
            'nivel_id' => $request->niv,
            'respuesta' => $request->respuesta
        ]);

        return redirect()->route('preguntas')->with('status', 'Exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return view('pregunta.ver', ['pregunta' => Pregunta::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);

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
        $pregunta = Pregunta::findOrFail($id);

        $pregunta->nombre = $request->get('nombre');       

        $pregunta->save();

        //$url = action('PermissionController@show', ['id' => $permiso->id]);

        $request->session()->flash('status', 'Pregunta <a href="#">' . $pregunta->nombre . '</a> Actualizada');

        return redirect()->route("pregunta.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->delete();
        
        $request->session()->flash('status', 'Borrado!');
    }
}
