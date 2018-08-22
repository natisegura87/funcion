@extends('layouts.app')
@section('title', 'Organigrama')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
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
        <div class="form-group ocultar" style="display: none;">                                       
              
            </div>            
            <div class="form-group">
                <button type="submit" class="btn btn-info" style="margin-top: 25px; 
                margin-left: 20%;">Ver Organigrama por Unidad</button>
              
            </div>
        </form>
       
    </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
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
            <form role="form" method="Post" action="{{ action('OrganigramaController@showP') }}">
                {!! csrf_field() !!}


                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Puestos</label>
                    <select class="form-control puesto" name="pue" id="nivel" required>
                      <option value="">=== Select Puesto ===</option>
                        @foreach ($puestos as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
            <div class="form-group ocultar2" style="display: none;">                                       
              
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-info" style="margin-top: 25px; margin-left: 20%;">Ver Organigrama por Puesto</button>
              
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
        console.log(unidad_id);
        var div = $(this).parent().parent();
        //console.log("hola");
        var url = '{{ route('organigrama.get') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'iddependencia':unidad_id},
            success:function(data){
                console.log('success');
                //var x = data[0].id;
                console.log(data);
                op+='<input type="text" name="iddependencia" id="iddependencia" class="form-control input-sm" value="'+data+'">';
                
                console.log(op);
                div.find('.ocultar').html(" ");
                div.find('.ocultar').append(op);
            },
            error:function(){
                
            }
        });

    })

    $(document).on('change','.puesto',function(){        
        var idpue = $(this).val();
        console.log(idpue);
        var div = $(this).parent().parent();
        //console.log("hola");
        var url = '{{ route('organigrama.getP') }}';
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


    $("p").click(function(){
        $(this).hide();
    });
});
  </script>

@endsection

 