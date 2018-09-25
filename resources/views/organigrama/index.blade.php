@extends('layouts.app')
@section('title', 'Graficar Organigrama')
@section('content')



<div class="container">


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Seleccione organismo que desea ver</label>
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
            <form role="form" method="Post" action="{{ action('OrganigramaController@showNomenclador') }}">
                {!! csrf_field() !!}


                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Organismo</label>
                    <select class="form-control organismo" name="organismo" id="organismo" required>
                      <option value="">=== Select Organismo ===</option>
                        @foreach ($organismos as $organismo)
                            <option value="{{ $organismo->codigo }}">
                                {{ $organismo->organismos }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">A partir de que puesto</label>
                    <select class="form-control puesto" name="pue" >
                        <option value="">=== Select Puesto ===</option>                     
                    </select>
                </div>

                 <div class="form-group ocultar" style="display: none;"></div>
                
            <div class="form-group">
                <button disabled type="submit" class="btn btn-primary" style="margin-top: 25px;" id="ver1"> Ver Organigrama por Organismo</button>
              
            </div>
        </form>
       
    </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Seleccione a partir de que puesto desea ver</label>
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
<form role="form" method="Post" action="{{ action('OrganigramaController@showNomenclador') }}">
                {!! csrf_field() !!}


                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Puestos</label>
                    <select class="form-control puesto2" name="pue" id="nivel" required>
                      <option value="1">=== Select Puesto ===</option>
                        @foreach ($puestos as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombrepuesto }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
            <div class="form-group ocultar2" style="display: none;">                                       
              
            </div> 
            <div class="form-group">
                <button type="submit" disabled class="btn btn-primary" style="margin-top: 25px; margin-left: 20%;" id="ver">Ver Organigrama por Puesto</button>
              
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

    $(document).on('change','.organismo',function(){        
        var op_id = $(this).val();
        console.log(op_id);
        var div = $(this).parent().parent();
        //console.log("hola");
        var url = '{{ route('puestosDep.getop') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'idop':op_id},
            success:function(data){
                console.log('success');

                console.log(data);
                op+='<option value="1">=== Select Puesto ===</option>';
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].nomenclador_id+'">'+data[i].puesto_name+'</option>';
                }
                //console.log(op);

                div.find('.puesto').html(" ");
                div.find('.puesto').append(op);
            },
            error:function(){
                
            }
        });

    })

$(document).on('change','.puesto',function(){        
        var idpue = $(this).val();
        var idorga = "1";
        console.log(idpue);
        var div = $(this).parent().parent();
        console.log("hola");
        var url = '{{ route('organigrama.crearPuestos') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'iddependencia':idpue
                  
                    },
            success:function(data){
                console.log('success');
                //var x = data[0].id;
                console.log(data);
                op+='<input type="text" name="iddependencia" id="iddependencia" class="form-control input-sm" value="'+data+'">';
                
                console.log(op);
                div.find('.ocultar').html(" ");
                div.find('.ocultar').append(op);
                $('#ver1').attr('disabled', false);
            },
            error:function(){
                
            }
        });

    })

$(document).on('change','.puesto2',function(){        
        var idpue = $(this).val();
        var idorga = "1";
        console.log(idpue);
        var div = $(this).parent().parent();
        console.log("hola");
        var url = '{{ route('organigrama.crearPuestos') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'iddependencia':idpue
                  
                    },
            success:function(data){
                console.log('success');
                //var x = data[0].id;
                console.log(data);
                op+='<input type="text" name="iddependencia" id="iddependencia" class="form-control input-sm" value="'+data+'">';
                
                console.log(op);
                div.find('.ocultar2').html(" ");
                div.find('.ocultar2').append(op);
                $('#ver').attr('disabled', false);
            },
            error:function(){
                
            }
        });

    })

    $("#sigcompl").click(function(){
       console.log('success');
    });

    $("p").click(function(){
        $(this).hide();
    });
});
  </script>

@endsection

 