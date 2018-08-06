<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Paciente;
use App\Turno;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::paginate(20);
        $pacientes->setPath('pacientes');

        return view('pacientes.index', [
            'pacientes' => $pacientes
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PacienteRequest $request)
    {
        $paciente = Paciente::create([
            'nombre'   => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'telefono' => $request->get('telefono'),
            'dni' => $request->get('dni'),
            'observaciones' => $request->get('observaciones')

        ]);

        //$url = action('PermissionController@show', ['id' => $permiso->id]);

        $request->session()->flash('status', 'Paciente <a href="#">' . $paciente->nombre . '</a> Guardado');

        return redirect()->route("pacientes.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $paciente = Paciente::with('turnos')->findOrFail($id);

        return view('pacientes.ver')
            ->withPaciente($paciente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.editar')
            ->withPaciente($paciente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PacienteRequest $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->nombre = $request->get('nombre');
        $paciente->apellido = $request->get('apellido');
        $paciente->telefono = $request->get('telefono');
        $paciente->dni = $request->get('dni');
        $paciente->observaciones = $request->get('observaciones');

        $paciente->save();

        //$url = action('PermissionController@show', ['id' => $permiso->id]);

        $request->session()->flash('status', 'Paciente <a href="#">' . $paciente->nombre . '</a> Actualizado');

        return redirect()->route("pacientes.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->delete();


        return response()->json([
            "success"=>1,
            "flash"=>'Paciente <label>' . $paciente->nombre . '</label> Eliminado'
        ]);
    }
}
