@extends('layouts.app')
@section('title', 'Editar puesto')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
        
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
           

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <label class="control-label">Editar Puesto del Funcionario</label>
                    </h3>
                </div>
                <div class="panel-body">                    
                  
                        <form method="POST" action="{{ route('nomencladorfuncionarios.update',$preguntas->id) }}"  role="form">
                            {{ csrf_field() }}
                           
                                    <div class="form-group">
                                        <label class="control-label">Nombre del Puesto Funcionario</label>
                                        <input type="text" name="nombre" id="nombre" required class="form-control input-sm" 
                                        value="{{$preguntas->nombrepuesto}}">
                                    </div>
                             <div class="form-group">
                               <label class="control-label">Descripción</label>
                               <textarea class="form-control" name="descripcion" >{{$preguntas->descripcion}}
                               </textarea>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="row col-md-6" style="padding-bottom: 10px;">
                                    <label class="control-label">Organismos</label>
                                    <select class="form-control organismos" name="organismo" id="organismo" required>
                                      <option value="">=== Select Organismo ===</option>
                                       @foreach ($organismos as $codigo => $organismos)
                                            <option value="{{ $codigo }}"
                                                @if($codigo==$preguntas->op_codigo) selected='selected' @endif >
                                                    {{ $organismos }}
                                            </option>                           
                                        @endforeach 
                                    </select>
                                </div>

                                 <div class="col-md-6">
                                        <label class="control-label" id="labelo">Organismos: </label>
                                         <a style="cursor: pointer;padding-left: 30px;" id="limpiaro" onclick="limpiarorg()">Limpiar</a>
                                         <input type="text" name="org" value="{{ $preguntas->organismos }}" id="mostrarorg" style="display:none">
                                         <p id="mostrarorgp">

                                        <?php $idorg=$preguntas->organismos;
                                            $orga=explode(" ",$idorg);  ?>

                                            @foreach ($orga as $cond=>$val)
                                                @foreach ($organismosT as $organ)
                                                    @if($organ->codigo==$val) 
                                                        <p> {{ $organ->organismos }}</p>
                                                     @endif    
                                                                               
                                                @endforeach    
                                            @endforeach     
                                  
                                         </p>   
                                         <p id="mostrarorgp2" style="display: none;"></p>
                                     
                                    </div>

                              </div>

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('nomencladorfuncionarios.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

function limpiarorg(){
   console.log("entro limpiar org");    
    document.getElementById("mostrarorg").value = " ";
    document.getElementById("mostrarorgp").innerHTML = " ";
    $("p").hide();

}

$(document).on('change','.organismos',function(){        
   var org_id = $(this).val();
   var org_nombre = $('.organismos option:selected').text();
   console.log(org_nombre);
   console.log("entro org");
   $("#mostrarorgp").show();

  var vo= document.getElementById("mostrarorg").value;
  document.getElementById("mostrarorg").value += " " + org_id ; 

  console.log(vo);

  document.getElementById("mostrarorgp").innerHTML += "<p>" + org_nombre + "</p> ";

    })

  </script>
     
  @endsection

