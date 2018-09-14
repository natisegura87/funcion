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

                  <form action="" method="GET" action="{{ action('NomencladorController@index') }}" class="form form-inline" style="padding-bottom: 15px;">
                    <input type="text" name="codigo" class="form-control" placeholder="Código">
                    <input type="text" name="nombre" class="form-control" placeholder="Puesto">
                    <select name="agrupamiento" class="form-control">
                      <option value="">==Agrupamiento==</option>
                      @foreach($agrupamiento as $agrup)
                       <option value="{{$agrup->nombre}}">{{$agrup->nombre}}</option>
                      @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                    Buscar</button>
                  </form>

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
                        <th>Código</th> 
                        <th>Puesto</th>  
                        <th>Descripción</th>  
                        <th style="width: 104px;">Gente a cargo</th>                        
                        <th style="width: 61px;">Nivel</th>    
                        <th style="width: 105px;">Agrup y Clasif</th> 
                        <th>Condiciones</th>                       
                        <th>Acciones</th>                     
                    </tr>
                 </thead>
                    <tbody>            
                    @if($preguntas->count())  
                     @foreach($preguntas as $preg)
                        <tr>
                           <td>{{ $preg->codigo }}</td>                   
                           <td>{{ $preg->nombrepuesto }}</td>  
                           <td>
                            <?php
                            $condicion=explode("-",$preg->condiciones);?>
                             @foreach($condicion as $cond=>$val)
                                {{ $val }}
                              @endforeach 
                          </td> 
                           <td>@if($preg->genteacargo) 
                            SI
                            @else
                            NO
                            @endif
                          </td>
                           <td>{{ $preg->nivel_name }}
                              <a data-toggle="modal" data-target=".bd-ver-modal-lg" title="Ver {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-complejidad= "{{ $preg->nivel_complejidad }}" 
                            data-responsabilidad= "{{ $preg->nivel_responsabilidad }}" 
                            data-autonomia= "{{ $preg->nivel_autonomia }}" 
                            data-supervision= "{{ $preg->nivel_supervision }}" 
                            data-requisitos= "{{ $preg->nivel_requisitos }}" 
                            data-experiencia= "{{ $preg->nivel_experiencia }}"
                              class="btn btn-info btn-xs" style=" margin-right: 5px;"><i class="fa fa-eye fa-lg"></i></a>

                           </td>
                        
                            <td> 
                                     
                            <a data-toggle="modal" data-target=".bd-ver-agrup-modal-lg" title="Ver {{ $preg->nombrepuesto }}" 
                            data-ver= "{{ $preg->nombrepuesto }}" 
                            data-idver= "{{ $preg->id }}" 
                            data-agrupamiento= "{{ $preg->agrupamiento_name }}" 
                            data-subagrupamiento= "{{ $preg->subagrupamiento_name }}" 
                            data-clasificacion= "{{ $preg->clasificacion_name }}"
                            data-subclasificacion= "{{ $preg->subclasificacion_name }}"
                              class="btn btn-info btn-xs" style=" margin-right: 5px;"><i class="fa fa-eye fa-lg"></i></a>
                           </td>
                            <td>
                                     
                           <a data-toggle="modal" data-target=".bd-ver-cond-modal-lg" title="Ver {{ $preg->nombrepuesto }}" 
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

<div class="modal fade bd-ver-agrup-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ver</h4>
        </div>
     
    <div class="modal-body" style="padding-bottom: 0px;">    
        <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="agrupamiento"></p></li>
          <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="subagrupamiento"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="clasificacion"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="subclasificacion"></p></li>
          <hr>
      </ul>    
    <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
         <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>

        </div>
    </div>
  </div>
</div>

<div class="modal fade bd-ver-cond-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ver</h4>
        </div>
     
    <div class="modal-body" style="padding-bottom: 0px;">  
    <label>Organismos</label>  
        <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="agrupamiento"></p></li>
          <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="subagrupamiento"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="clasificacion"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="subclasificacion"></p></li>
          <hr>
      </ul>    
    <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
         <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>

        </div>
    </div>
  </div>
</div>

@include('puesto.modal')

@endsection