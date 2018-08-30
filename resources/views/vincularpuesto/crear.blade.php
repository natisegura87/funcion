@extends('layouts.app')
@section('title', 'Crear puesto')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Crear Vinculo de Puestos</label>

                    
                 </div>


    <div class="panel-body">
     
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form role="form" method="POST" action="{{ action('VincularpuestoController@store') }}">
                {!! csrf_field() !!}

          
<div class="form-group col-md-12" style="background-color: #3097d1;border-radius: 5px;">
            <div class="row col-md-6" style="padding: 10px">
                    <label class="control-label">Regimen</label>
                    <select class="form-control regimen" name="regimen" id="regimen" required>
                      <option value="">=== Select Regimen ===</option>
                       @foreach ($regimen as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
        </div>
                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nombre del Puesto</label>
                    <select class="form-control puesto" name="puesto" id="puesto" required>
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Nivel de la estructura (Unidades)</label>
                    <select class="form-control unidad" name="uni" id="unidad" required>
                      <option value="">=== Select Unidad ===</option>
                        
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Puesto del que depende</label>
                    <select class="form-control puestoDep" name="dep" id="puesto" required>
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
                
       

             <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Guardar</button>
                <a href="{{ action('VincularpuestoController@index') }}" class="btn btn-default" style="margin-top: 20px;">Cancelar</a>
            </div>

                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>


    <style type="text/css">
        .bar {
            height: 18px;
            background: green;
        }
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $(document).on('change','.regimen',function(){        
        var regimen = $(this).val();      
        var div = $(this).parent().parent().parent();
        var url = '{{ route('vincularpuesto.get') }}';

        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':regimen},
            success:function(data){
                //console.log('success');

                //console.log(data);
                op+='<option value="">=== Select Unidad ===</option>';
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
                //console.log(op);
                div.find('.unidad').html(" ");
                div.find('.unidad').append(op);
            },
            error:function(){
                
            }
        });

        var url1 = '{{ route('vincularpuesto.getP') }}';

        var op1= " ";
        $.ajax({
            type:'get',
            url:url1,
            data:{'id':regimen},
            success:function(data){
                //console.log('success');

                //console.log(data);
                op1+='<option value="">=== Select Puesto ===</option>';
                var keys = Object.keys(data);

                for (var i=0;i<keys.length;i++){
                    var key = keys[i];
                    op1+='<option value="'+key+'">'+data[key]+'</option>';
                }
                //console.log(op1);
                div.find('.puesto').html(" ");
                div.find('.puesto').append(op1);
            },
            error:function(){
                
            }
        });

    })

    $(document).on('change','.unidad',function(){        
        var unidad_id = $(this).val();
        //console.log(unidad_id);
        var div = $(this).parent().parent().parent();
        //console.log("hola");
        var url = '{{ route('vincularpuesto.getD') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unidad_id},
            success:function(data){
                //console.log('success');

                //console.log(data.length);
                if(data.length)
                  op+='<option value="">=== Select Puesto ===</option>';
                else
                  op+='<option value="">=== No hay puestos cargados ===</option>';
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].nomenclador_id+'">'+data[i].puesto_name+'</option>';
                }
                //console.log(op);
                div.find('.puestoDep').html(" ");
                div.find('.puestoDep').append(op);
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
