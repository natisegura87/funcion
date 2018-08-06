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
          
  <form role="form" method="POST" action="{{ action('PacientesController@update') }}">
                {!! csrf_field() !!}


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


           