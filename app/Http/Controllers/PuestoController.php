<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Unidad;
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

        $unidad = Unidad::orderBy('orden','ASC')->firstOrFail();
        $iduSup = $unidad['id'];
        //dd($idSup);
        //hijo id unidad anterior

       
        
        $superior = Puesto::where('id-unidad',$iduSup)->firstOrFail();
        //dd($superior->toArray());
        //dd($superior->toJson()); //este devuelve uno
        //dd($superior->nombre);   
        $idSup= $superior->id; 

         $datascource = [
              'name'=> $superior->nombre,
              'title'=> 'general manager',
              'relationship'=> '1',
              'children'=> [
                  
                      ]
            ];
        //dd($datascource);
        
        //$puestos = Puesto::all();
       // $puestos = Puesto::all();
       // foreach($puestos as $pue){ // no es necesario
            //dd($idSup); 
           /* $v = $pue->padre;
            $id= $pue->id;
            $padre = $pue->iddependencia;*/
            $collection = Puesto::all()
                    ->where('iddependencia',$idSup)
                    ->where ('id','!=',$idSup);

            //$chunks->toArray();

           $hijos= collect([$superior->toJson()]);
           //dd($hijos);

            //dd($collection->toJson()); // los hijos
            //dd($collection->toArray());
           foreach($collection as $co){
            echo ". ver " . $co->nombre;
            //$hijos->push($co->toJson());
            //dd($hijos);
            //dd($co->toJson());
           }
           //dd($hijos);

            /*if($pue->padre){ //1 verdadero
                if($pue->id == $pue->iddependencia)
                    dd($pue->nombre);
            }*/
        //}

//$collection->all();
//dd($collection->all());

// [1, 2, 3, 4]
        /*   $username = 'Natalia';
 
        return view('mix.index')->with('username', $username);*/
       
        // aca
        $unidades = Puesto::all()->where('id-unidad',2);
        //dd($unidades->toJson());
        //$unidades = $unidades->toJson();
        

        //$unidades = $unidad->toJson();
        //$unidades = $unidad->toArray();
        //dd($unidades); // este seria hijos
        //return view('mix.index', compact('uni'));
        return view('mix.index', ['unidades' => $unidades]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Puesto $puesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto $puesto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto)
    {
        //
    }
}
