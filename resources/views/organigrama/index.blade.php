@extends('layouts.app')
@section('title', 'Graficar Organigrama')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Seleccione a partir de que nivel de la estructura desea ver</label>
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
            <form role="form" method="Post" action="{{ action('OrganigramaController@show') }}">
                {!! csrf_field() !!}


                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Unidades</label>
                    <select class="form-control unidad" name="uni" id="nivel" required>
                      <option value="">=== Select Unidad ===</option>
                        @foreach ($unidades as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">A partir de que dependencia</label>
                    <select class="form-control puesto" name="iddependencia" id="iddependencia" >
                        <option value="">=== Select Dependencia ===</option>                     
                    </select>
                </div>
                
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-top: 25px;"> Ver Organigrama por Unidad</button>
              
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
                      <option value="">=== Select Puesto ===</option>
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
                <button type="submit" class="btn btn-primary" style="margin-top: 25px; margin-left: 20%;">Ver Organigrama por Puesto</button>
              
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

    $(document).on('change','.unidad',function(){        
        var unidad_id = $(this).val();
        //console.log(unidad_id);
        var div = $(this).parent().parent();
        //console.log("hola");
        var url = '{{ route('puestosDep.get') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unidad_id},
            success:function(data){
                console.log('success');

                console.log(data);
                op+='<option value="7">=== Select Puesto ===</option>';
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

        $(document).on('change','.puesto2',function(){        
        var idpue = $(this).val();
        console.log(idpue);
        var div = $(this).parent().parent();
        console.log("hola");
        var url = '{{ route('organigrama.crearPuestos') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'iddependencia':idpue},
            success:function(data){
                console.log('success');
                //var x = data[0].id;
                console.log(data);
                op+='<input type="text" name="iddependencia" id="iddependencia" class="form-control input-sm" value="'+data+'">';
                
                console.log(op);
                div.find('.ocultar2').html(" ");
                div.find('.ocultar2').append(op);
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

 