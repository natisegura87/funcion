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
           

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <label class="control-label">Editar Puesto</label>
                    </h3>
                </div>
                <div class="panel-body">                    
                  
                        <form method="POST" action="{{ route('puestos.update',$preguntas->id) }}"  role="form">
                            {{ csrf_field() }}
                          
                    
                           
                                    <div class="form-group">
                                        <label class="control-label">Puesto</label>
                                        <input type="text" name="nombre" id="nombre" required class="form-control input-sm" value="{{$preguntas->nombre}}">
                                    </div>
                             
        <div class="col-md-6">
              
                  <label class="control-label">Organismo</label>
                   <select class="form-control" name="op" id="op" required>
                   <option value="">=== Select Organismo ===</option>
                        @foreach ($niveles as $codigo => $organismos)
                            <option value="{{ $codigo }}"
                                @if($codigo==$preguntas->op_codigo) selected='selected' @endif >
                                 {{ $organismos }}
                            </option>                           
                        @endforeach
                    </select>
           
        </div>

                               


  <div class="form-group">
     <div class="col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nivel de la estructura (Unidades)</label>
                    <select class="form-control unidad" name="uni" id="unidad" required>
                      <option value="">=== Select Unidad ===</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}"
                               @if($unidad->id==$preguntas->unidad_id) selected='selected' @endif >
                                {{ $unidad->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                 <div class="col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Puesto del que depende</label>
                    <select class="form-control puesto" name="dep" id="puesto" required>
                     <option value="">=== Select Puesto ===</option>
                        @foreach ($puestos as $unidad)
                            <option value="{{ $unidad->id }}"
                               @if($unidad->id==$preguntas->iddependencia) selected='selected' @endif >
                                {{ $unidad->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Empleados</label>
                    <select class="form-control" name="empleado" id="empleado" required>
                      <option value="">=== Select Empleado ===</option>                    
                        @foreach ($empleados as $legajo => $nombre)
                            <option value="{{ $legajo }}"
                                 @if($legajo==$preguntas->empleado) selected='selected' @endif >
                                {{ $nombre }} - LEG {{ $legajo }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                  <div class="col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Agrupamiento</label>
                    <select class="form-control" name="agrup" id="agrup" required>
                      <option value="">=== Select Agrupamiento ===</option>
                        @foreach ($agrupamiento as $agrup)
                            <option value="{{ $agrup->id }}"
                               @if($agrup->id==$preguntas->agrupamiento_id) selected='selected' @endif >
                                {{ $agrup->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>


                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('puestos.index') }}" class="btn btn-info btn-block" >Atrás</a>
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

    $("p").click(function(){
        $(this).hide();
    });
});
  </script>

      
  @endsection

