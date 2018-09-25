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
                    <label class="control-label">Editar Puesto Nomenclador</label>
                    <p id="titulo" style="float: right;">Nivel  {{$preguntas->nivel_id}}</p>
                    </h3>
                </div>
                <div class="panel-body">                    
                  
                    <form method="POST" action="{{ route('nomenclador.update',$preguntas->id) }}"  role="form">
                    {{ csrf_field() }}

                     <div class="ver-nombre" class="form-group" >
                        
                        <div class="form-group col-xs-12 col-sm-12 col-md-4" style="padding-left: 0px;">
                           <label class="control-label">Código del Puesto</label>
                           <input type="text" class="form-control" name="codigo" required 
                            value="{{$preguntas->codigo}}">
                        </div> 
                        <div class="form-group col-xs-12 col-sm-12 col-md-8" style="padding-left: 0px;">
                           <label class="control-label">Nombre del Puesto</label>
                           <input type="text" class="form-control" name="nombre" required 
                            value="{{$preguntas->nombrepuesto}}">
                        </div>
                        <div class="form-group" style="padding-right: 15px;">
                           <label class="control-label">Descripción</label>
                           <textarea class="form-control" name="descripcion">{{$preguntas->descripcion}}
                           </textarea>
                        </div>
                    </div>

            <div class="ver-nivel" class="form-group">         
           
                
                <div class="row col-md-3" style="margin-right: 8px">
                    <label class="control-label">Agrupamientos</label>
                    <select class="form-control agrupamiento" name="agrupamiento" id="agrupamiento">
                      <option value="Ninguno">- Select Agrupamiento -</option>
                         @foreach ($agrupamientos as $clasi)
                            <option value="{{ $clasi->id }}"
                                 @if($clasi->id==$preguntas->agrupamiento_id) selected='selected' @endif >
                                {{ $clasi->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                 
                </div>
                <div class="row col-md-3" style=" margin-right: 8px;">
                    <label class="control-label">Subagrupamiento</label>
                    <select class="form-control subagrupamiento" name="subagrupamiento" id="subagrupamiento" >
                      <option value="Ninguno">- Select Subagrupamiento -</option>
                         @foreach ($subagrupamientos as $clasi)
                            <option value="{{ $clasi->id }}"
                                @if($clasi->id==$preguntas->subagrupamiento_id) selected='selected' @endif >
                                {{ $clasi->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                 
                </div>
                  <div class="row col-md-3" style="margin-right: 8px">
                    <label class="control-label">Clasificación</label>
                    <select class="form-control clasificacion" name="clasificacion" id="clasificacion">
                      <option value="Ninguno">- Select Clasificación -</option>
                        @foreach ($clasificacion as $clasi)
                            <option value="{{ $clasi->id }}"
                                @if($clasi->id==$preguntas->clasificacion_id) selected='selected' @endif >
                                {{ $clasi->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                 
                </div>
                <div class="row col-md-3" style=" padding-bottom: 30px;margin-right: 8px">
                    <label class="control-label">Subclasificación</label>
                    <select class="form-control subclasificacion" name="subclasificacion" id="subclasificacion">
                      <option value="Ninguno">- Select Subclasificación -</option>
                         @foreach ($subclasificacion as $clasi)
                            <option value="{{ $clasi->id }}"
                                @if($clasi->id==$preguntas->subclasificacion_id) selected='selected' @endif >
                                {{ $clasi->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                 
                </div>
              
                <p></p>

      <div class="ver-requisitos" class="form-group" > 
                 
                  
        <div class="row" style="padding: 15px; ">
           <div class="form-group">
             <label style="font-size: 16px; padding: 5px;
                 background-color: rgb(82, 165, 86);">Condiciones Excluyentes</label>
           </div>
      @foreach ($excluyentes as $exclu)
          @if($exclu->id==1) 
              <div class="row col-md-4" style="margin-bottom: 15px;margin-right: 10px">
                    <label class="control-label">{{ $exclu->nombre }}</label>
                    <select class="form-control organismos" name="condicion{{ $exclu->id }}" >
                      <option value="Ninguno">- Select -</option>  
                            @foreach ($organismos as $organ)
                                <option value="{{ $organ->codigo }}"
                                    @if($organ->codigo==$preguntas->organismos) selected='selected' @endif >
                                    {{ $organ->organismos }}
                                </option>                  
                            @endforeach  
                    </select>                 
                </div>  
           @else

            <?php $idcond=$preguntas->condiciones;
            $condi=explode("-",$idcond); 
            $entro=1; ?>
                <div class="row col-md-4" style="margin-bottom: 15px;margin-right: 10px">
                    <label class="control-label">{{ $exclu->nombre }}</label>
                    <select class="form-control condiciones" name="condicion{{ $exclu->id }}" >
                      <option value="Ninguno">- Select -</option>
                        @foreach ($condiciones as $nivel) 
                          @foreach ($condi as $cond=>$val)
                            @if($exclu->id==$nivel->excluyente_id) 
                              @if($entro)
                                <?php $entro=0; ?>
                                <option value="{{ $nivel->id }}"
                                    @if($nivel->id==$val) selected='selected' @endif >
                                    {{ $nivel->nombre }}
                                </option>  
                              @endif    
                            @endif                          
                          @endforeach 
                        <?php $entro=1; ?>
                        @endforeach   

                    </select>                 
                </div>  
             @endif        
   @endforeach
    </div>
    <div class="col-md-6">
        <label class="control-label" id="labelo">Organismos: </label>
         <a style="cursor: pointer;padding-left: 30px;" id="limpiaro" onclick="limpiarorg()">Limpiar</a>
         <input type="text" name="org" value="{{ $preguntas->organismos }}" id="mostrarorg" style="display:none">
         <p id="mostrarorgp">

        <?php $idorg=$preguntas->organismos;
            $orga=explode(" ",$idorg);  ?>

            @foreach ($orga as $cond=>$val)
                @foreach ($organismos as $organ)
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
                                     <a href="{{ route('nomenclador.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                   
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
$(document).ready(function(){

    $(document).on('change','.unidad',function(){        
        var unidad_id = $(this).val();
        //console.log(unidad_id);
        var div = $(this).parent().parent();
        //console.log("hola");
        var url = '{{ route('puestos.get') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unidad_id},
            success:function(data){
                //console.log('success');

                //console.log(data);
                op+='<option value="">=== Select Puesto ===</option>';
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
                //console.log(op);
                div.find('.puesto').html(" ");
                div.find('.puesto').append(op);
            },
            error:function(){
                
            }
        });

    })

});

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

