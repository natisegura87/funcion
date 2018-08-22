@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
               
             <div class="panel-heading">
                <label>Niveles</label>
                <a href="{{ action('PreguntaController@create') }}" class="btn btn-default" 
                style="float: right; margin-top: -4px;"> Crear </a>
            </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" id="alert">
                            {{ session('status') }}
                        </div>
                    @endif              

                <table class="table table-bordered table-hover">
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
                    @if($preguntas->count())  
                     @foreach($preguntas as $preg)
                        <tr>
                            <td>{{ $preg->id }}</td>                      
                            <td>{{ $preg->nombre }}</td>
                            <td>{{ $preg->respuesta }}</td>
                            <td>{{ $preg->nivel_name }}</td>
                            <td>                          
                                <a href="{{ action('PreguntaController@edit', $preg->id) }}" title="Editar"
                                   class="btn btn-primary btn-xs" style="    margin-right: 5px;float:left"><i class="fa fa-pencil-square-o fa-lg"></i></a>

                           
                    <form action="{{action('PreguntaController@destroy', $preg->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
 
                   <button class="btn btn-danger btn-xs" title="{{ $preg->nombre }}" type="submit" onclick="return confirm('Deseas eliminar {{ $preg->nombre }} ?');">  <i class="fa fa-trash-o fa-lg"></i>   </button>
                 </form>
                            </td>
                        </tr>
                    @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
                     </tbody>
                </table>

       

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