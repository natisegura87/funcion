@extends('layouts.app')
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
                    <label class="control-label">Editar Pregunta</label>
                    </h3>
                </div>
                <div class="panel-body">                    
                    <div class="table-container">
                        <form method="POST" action="{{ route('preguntas.update',$preguntas->id) }}"  role="form">
                            {{ csrf_field() }}
                          
                            <div class="row">
                           
                                    <div class="form-group">
                                        <label class="control-label">Pregunta</label>
                                        <input type="text" name="nombre" id="nombre" required class="form-control input-sm" value="{{$preguntas->nombre}}">
                                    </div>
                             
        <div class="col-xs-6 col-sm-6 col-md-6">
               <div class="form-group">
                  <label class="control-label">Nivel</label>
                   <select class="form-control" name="niv" id="nivel" required>
                    <option value="">=== Select Nivel ===</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}"
                                @if($nivel->id==$preguntas->nivel_id) selected='selected' @endif >
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
            </div>
        </div>

                               
 </div>

  <div class="form-group">
     <label for="color">Respuesta:</label>
    <br>
<input type="radio" required name="respuesta" id="respuesta" value="Si"
@if("Si"==$preguntas->respuesta) checked @endif
>Si<br>
<input type="radio" name="respuesta" id="respuesta" value="No"
@if("No"==$preguntas->respuesta) checked @endif
>No<br>

</div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('preguntas.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endsection