@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear preguntas</div>
    <div class="panel-body">

        @if (Session::get('status'))
            <div class="alert alert-success  alert-dismissable " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {!! Session::get('status') !!}.
            </div>
        @endif

        @section ('panel1_panel_body')
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
 <i class="fa fa-trash-o fa-lg"></i>    
 <i class="fa fa-pencil-square-o fa-lg"></i>

      
  <form role="form" method="POST" action="{{ action('PacientesController@update') }}">
                {!! csrf_field() !!}
                <input name="_method" type="hidden" value="PATCH">

                <div class="form-group {{$errors->has('nombre') ? 'has-error' : ''}}">
                   <label class="control-label">Pregunta</label>
                   <input type="text" class="form-control" name="nombre" value="">
                </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ action('PreguntaController@edit') }}" class="btn btn-default">Cancelar</a>           
      
      </form>

 </div>

            </div>
        </div>
    </div>
</div>
@endsection


            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="edicion" id="edicion" class="form-control input-sm" value="{{$preguntas->nombre}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="precio" id="precio" class="form-control input-sm" value="{{$preguntas->nombre}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="autor" class="form-control input-sm" placeholder="Autor">{{$preguntas->nombre}}</textarea>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('preguntas.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>