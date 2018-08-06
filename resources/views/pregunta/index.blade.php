@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                 @yield('pregunta')
             <div class="panel-heading">
                <label>Responda las preguntas</label>
                <a href="{{ action('PreguntaController@create') }}" class="btn btn-default" 
                style="float: right;"> Crear Pregunta</a>
            </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" id="alert">
                            {{ session('status') }}
                        </div>
                    @endif              

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th> 
                        <th>Respuesta</th>   
                        <th>Nivel</th> 
                        <th>Acciones</th>                     
                    </tr>
                 </thead>
                    <tbody>            
                   
                     @foreach($preguntas as $preg)
                        <tr>
                            <td>{{ $preg->id }}</td>                      
                            <td>{{ $preg->nombre }}</td>
                            <td>{{ $preg->respuesta }}</td>
                            <td>{{ $preg->nivel_name }}</td>
                           


                            <td>
                                <a href="{{ action('PreguntaController@edit', $preg->id) }}" title="Editar"
                                   class="action" style="float:left"><i class="fa fa-pencil-square-o fa-lg"></i></a>

                                <a href="{{ action('PreguntaController@destroy', $preg->id) }}"
                                   class="action eliminar"
                                   title="{{ $preg->nombre }}"
                                   data-id="{{$preg->id}}"
                                   style="float: left;color: #B91A1A;cursor: pointer">
                                    <i class="fa fa-trash-o fa-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach
                     </tbody>
                </table>

                {{ $preguntas->links() }}

                </div>
            </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
      
      setTimeout(function() {
           $("#alert").fadeOut();           
      },2000);

</script>
@endsection