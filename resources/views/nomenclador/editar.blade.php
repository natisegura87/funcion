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
                    </h3>
                </div>
                <div class="panel-body">                    
                  
                        <form method="POST" action="{{ route('nomenclador.update',$preguntas->id) }}"  role="form">
                            {{ csrf_field() }}
                          
                    <div class="form-group">
                           <label class="control-label">Nombre del Puesto</label>
                           <input type="text" class="form-control" name="nombre" required 
                            value="{{$preguntas->nombrepuesto}}">
                        </div>
                        <div class="form-group">
                           <label class="control-label">Descripción</label>
                           <textarea class="form-control" name="descripcion">{{$preguntas->descripcion}}
                           </textarea>
                        </div>


                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('nomenclador.index') }}" class="btn btn-info btn-block" >Atrás</a>
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

