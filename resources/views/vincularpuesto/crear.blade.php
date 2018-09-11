@extends('layouts.app')
@section('title', 'Vincular Puestos')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
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

          
<div class="form-group col-md-12" style="background-color: #52a556;border-radius: 5px;">
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
                <div class="row col-md-6" style="padding-top: 10px; margin-left: 30px;">
                    <label class="control-label">Organismos</label>
                    <select class="form-control " name="organismo" id="organismo" required>
                      <option value="">=== Select Organismo ===</option>
                       @foreach ($organismos as $organ)
                            <option value="{{ $organ->codigo }}">
                                {{ $organ->organismos }}
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
                    <label class="control-label">Localidades</label>
                    <select class="form-control localidad" name="localidad" id="localidad" required>
                      <option value="">=== Select Localidad ===</option>
                         @foreach ($localidad as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nivel de la estructura (Unidades)</label>
                    <select class="form-control unidad" name="uni" id="unidad" required>
                      <option value="">=== Select Unidad ===</option>
                        
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Puesto del que depende</label>
                    <select class="form-control puestoDep" name="dep" id="puestoD" 
                    required >
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
        <div class="col-xs-12 col-sm-12 col-md-12">        
            <input type="checkbox" name="vacante"> Genera vacante
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
    var organism="1";
    var unid="1";
    $(document).on('change','.organismo',function(){        
        organism = $(this).val();
         var div = $(this).parent().parent().parent();
        //console.log("hola");
        var url = '{{ route('vincularpuesto.getO') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unid,
                'organismo':organism
                },

            success:function(data){
                console.log('ver');
                console.log(organism);
                //console.log(data.length);
                if(data.length){
                    op+='<option value="">=== Select Puesto ===</option>';             
                }                  
                else{
                    $("select#puestoD").css("color", "#f70e0a");
                    $("select#puestoD").css("font-size", "18px");
                    op+='<option value="">- No hay puestos cargados -</option>';
                }
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

    $(document).on('change','.unidad',function(){        
        unid = $(this).val();
        //console.log(unidad_id);
        var div = $(this).parent().parent().parent();
        //console.log("hola");
        var url = '{{ route('vincularpuesto.getD') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unid,
                'organismo':organism
                },

            success:function(data){
                console.log('ver');
                console.log(organism);
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

$(document).ready(function(){
    $("select").focus(function(){
       $("select#puestoD").css("color", "#555");
       $("select#puestoD").css("font-size", "14px");
        
    });
});
  </script>

      
  @endsection

