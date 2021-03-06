@extends('layouts.app')
@section('title', 'Nomenclador Funcionarios')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
             <div class="panel-heading">
                <label>Nomenclador de Funcionarios</label>
                <a href="{{ action('NomencladorController@createF') }}" class="btn btn-success" 
                style="float: right; margin-top: -4px;"> Crear Puesto Funcionario</a>
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
                     
                        <th>Nombre del Puesto</th>  
                        <th style="width: 40%;">Descripción</th>  
                        <th style="width: 30%;">Organismos</th>
                        <th>Acciones</th>                     
                    </tr>
                 </thead>
                    <tbody>            
               @if($preguntas->count())  
                     @foreach($preguntas as $preg)

                        <tr>                                             
                           <td>{{ $preg->nombrepuesto }}</td>  
                           <td>{{ $preg->descripcion }}</td>                          
                           <td>

                           <?php $idorg=$preg->organismos;
                                            $orga=explode(" ",$idorg);  ?>

                                            @foreach ($orga as $cond=>$val)
                                                @foreach ($organismos as $organ)
                                                    @if($organ->codigo==$val) 
                                                        {{ $organ->organismos }}<br>
                                                     @endif    
                                                                               
                                                @endforeach    
                                            @endforeach     
                                          </td>  
                            <td>
                                <a href="{{ action('NomencladorController@editF', $preg->id) }}" title="Editar"
                                   class="btn btn-primary btn-xs" style=" margin-right: 5px;margin-bottom: 2px;float:left">Editar</a>

                           
                  <form action="{{action('NomencladorController@destroyF', $preg->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
 
                   <button class="btn btn-danger btn-xs" title="{{ $preg->nombrepuesto }}" type="submit" onclick="return confirm('Deseas eliminar {{ $preg->nombrepuesto }} ?');"> Eliminar</button>
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