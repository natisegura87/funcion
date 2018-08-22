@extends('layouts.app')
@section('title', 'Crear puesto')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                <label class="control-label">Crear Puesto</label>

                    <form action="{{action('PuestoController@index')}}" method="post">
                   {{csrf_field()}}                  
 
                   <button type="button" class="btn btn-success" data-toggle="modal" style="float: right; margin-top: -30px;" data-target="#myModal">Preguntas Nivel</button>
                 </form>
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
            <form role="form" method="POST" action="{{ action('PuestoController@store') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                   <label class="control-label">Nombre del Puesto</label>
                   <input type="text" class="form-control" name="nombre" value="" required 
                   onfocus="this.value=''" placeholder="Escribe aqui..">
                </div>
<div class="form-group">
                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Organismo</label>
                    <select class="form-control" name="op" id="op" required>
                      <option value="">=== Select Organismo ===</option>
                        @foreach ($niveles as $codigo => $organismos)
                            <option value="{{ $codigo }}">
                                {{ $organismos }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Nivel de la estructura (Unidades)</label>
                    <select class="form-control unidad" name="uni" id="unidad" required>
                      <option value="">=== Select Unidad ===</option>
                        @foreach ($unidades as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Puesto del que depende</label>
                    <select class="form-control puesto" name="dep" id="puesto" required>
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
                <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Empleados</label>
                    <select class="form-control" name="empleado" id="empleado" required>
                      <option value="">=== Select Empleado ===</option>
                        @foreach ($empleados as $legajo => $nombre)
                            <option value="{{ $legajo }}">
                                {{ $nombre }} - LEG {{ $legajo }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Agrupamiento</label>
                    <select class="form-control" name="agrup" id="agrup" required>
                      <option value="">=== Select Agrupamiento ===</option>
                        @foreach ($agrupamiento as $agrup)
                            <option value="{{ $agrup->id }}">
                                {{ $agrup->nombre }}
                            </option>                         
                        @endforeach
                    </select>
                </div>
       
</div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Guardar</button>
                <a href="{{ action('PuestoController@index') }}" class="btn btn-default" style="margin-top: 20px;">Cancelar</a>
            </div>

                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Complejidad</h4>
        </div>
       
      <div class="modal-body">
        <form>
            <div class="form-group">
                    <label class="control-label">Organismo</label>
                    <select class="form-control" name="op" id="op" required>
                      <option value="">=== Select Organismo ===</option>
                       
                    </select>
            </div>
         <div class="form-group">
             <label for="color">Respuesta:</label>
                <br>
                <input type="radio" required name="respuesta" id="respuesta" value="Si">Si<br>
                <input type="radio" required name="respuesta" id="respuesta" value="No">No<br>
         </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
        <button type="button" class="btn btn-primary">Siguiente</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Complejidad</h4>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Atras</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Siguiente</button>         
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

