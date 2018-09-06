@extends('layouts.app')
@section('title', 'Nomenclador')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
               
             <div class="panel-heading">
                <label>Nomenclador de Puestos</label>
                <a href="{{ action('NomencladorController@create') }}" class="btn btn-success" 
                style="float: right; margin-top: -4px;"> Crear Puesto</a>
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
                        <th>Descripción</th>  
                        <th>Tiene gente a cargo</th>                        
                        <th>Nivel</th>    
                        <th>Agrupamiento</th> 
                        <th>Condiciones</th> 
                        <th>Organismo</th> 
                        <th>Acciones</th>                     
                    </tr>
                 </thead>
                    <tbody>            
                    @if($preguntas->count())  
                     @foreach($preguntas as $preg)
                        <tr>
                                             
                           <td>{{ $preg->nombrepuesto }}</td>  
                           <td>{{ $preg->descripcion }}</td> 
                           <td>@if($preg->genteacargo) 
                            SI
                            @else
                            NO
                            @endif
                          </td>
                           <td>{{ $preg->nivel_name }}</td>
                           <td>{{ $preg->agrupamiento_name }}</td>
                            <td> <a data-toggle="modal" data-target=".bd-editar-modal-lg" title="Editar {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-complejidad= "{{ $preg->nivel_complejidad }}" 
                            data-responsabilidad= "{{ $preg->nivel_responsabilidad }}" 
                            data-autonomia= "{{ $preg->nivel_autonomia }}"                           
                              class="btn btn-primary btn-xs" style=" margin-right: 5px;float:left"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                     
                           <a data-toggle="modal" data-target=".bd-ver-modal-lg" title="Ver {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-complejidad= "{{ $preg->nivel_complejidad }}" 
                            data-responsabilidad= "{{ $preg->nivel_responsabilidad }}" 
                            data-autonomia= "{{ $preg->nivel_autonomia }}" 
                            data-supervision= "{{ $preg->nivel_supervision }}" 
                            data-requisitos= "{{ $preg->nivel_requisitos }}" 
                            data-experiencia= "{{ $preg->nivel_experiencia }}"
                              class="btn btn-info btn-xs" style=" margin-right: 5px;float:left"><i class="fa fa-eye fa-lg"></i></a>
                           </td>
                            <td> <a data-toggle="modal" data-target=".bd-editar-modal-lg" title="Editar {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-complejidad= "{{ $preg->nivel_complejidad }}" 
                            data-responsabilidad= "{{ $preg->nivel_responsabilidad }}" 
                            data-autonomia= "{{ $preg->nivel_autonomia }}"                           
                              class="btn btn-primary btn-xs" style=" margin-right: 5px;float:left"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                     
                           <a data-toggle="modal" data-target=".bd-ver-modal-lg" title="Ver {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-complejidad= "{{ $preg->nivel_complejidad }}" 
                            data-responsabilidad= "{{ $preg->nivel_responsabilidad }}" 
                            data-autonomia= "{{ $preg->nivel_autonomia }}" 
                            data-supervision= "{{ $preg->nivel_supervision }}" 
                            data-requisitos= "{{ $preg->nivel_requisitos }}" 
                            data-experiencia= "{{ $preg->nivel_experiencia }}"
                              class="btn btn-info btn-xs" style=" margin-right: 5px;float:left"><i class="fa fa-eye fa-lg"></i></a>
                           </td>
                         
                            <td>
                                <a href="{{ action('NomencladorController@edit', $preg->id) }}" title="Editar"
                                   class="btn btn-primary btn-xs" style=" margin-right: 5px;margin-bottom: 2px;float:left">Editar</a>

                           
                  <form action="{{action('NomencladorController@destroy', $preg->id)}}" method="post">
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

@include('puesto.modal')

@endsection