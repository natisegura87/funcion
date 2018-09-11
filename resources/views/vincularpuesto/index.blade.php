@extends('layouts.app')
@section('title', 'Puestos')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
             <div class="panel-heading">
                <label>Puestos del Organigrama</label>
                <a href="{{ action('VincularpuestoController@create') }}" class="btn btn-success" 
                style="float: right; margin-top: -4px;"> Crear vinculo de Puestos</a>
            </div>
                <div class="panel-body table-responsive">
                   @if (session('status'))
                        <div class="alert alert-success" id="alert">
                           <strong>
                            {{ session('status') }}
                            </strong>
                        </div>
                    @endif   
                    @if (session('error'))
                        <div class="alert alert-warning" role="alert">
                          <a href="#" class="alert-link">
                            {{ session('error') }}</a>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                    @endif                 

                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>                     
                        <th>Puesto</th>                        
                        <th>Unidad organizativa</th> 
                        <th>Puesto del que depende</th> 
                        <th>Localidad</th> 
                        <th>Organismo</th> 
                        <th>Acciones</th>                     
                    </tr>
                 </thead>
                    <tbody>            
                    @if($preguntas->count())  
                     @foreach($preguntas as $preg)
                        <tr>                                             
                            <td>{{ $preg->puesto_name }}</td>                   
                            <td>{{ $preg->unidad_name }}</td>
                            <td>{{ $preg->dependencia_name }}</td>
                            <td>{{ $preg->localidad_name }}</td>
                            <td>{{ $preg->op_name }}</td>
                          
                            <td>
                                <a href="{{ action('VincularpuestoController@edit', $preg->id) }}" title="Editar"
                                   class="btn btn-primary btn-xs" style="margin-right: 5px; margin-bottom: 2px;float:left">Editar</a>

                           
                  <form action="{{action('VincularpuestoController@destroy', $preg->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
 
                   <button class="btn btn-danger btn-xs" title="{{ $preg->nombre }}" type="submit" onclick="return confirm('Deseas eliminar {{ $preg->puesto_name }} ?');"> Eliminar</button>
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