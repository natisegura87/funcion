@extends('layouts.app')
@section('title', 'Crear puesto')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                  <label class="control-label">Crear Puesto del Nomenclador</label>
                  <p id="titulo" style="float: right;"></p>
                </div>


    <div class="panel-body">
       

 <form role="form" method="POST" action="{{ action('NomencladorController@store') }}">
                {!! csrf_field() !!}
      <div class="alert cartel alert-danger" style="display:none">           
              <label class="control-label alertc">Nivel</label>            
      </div>
     
 <div class="ver-nombre" class="form-group" >
                <div class="form-group">
                   <label class="control-label">Nombre del Puesto</label>
                   <input type="text" class="form-control" name="nombre" value="" required 
                    id="nombre">
                </div>
                <div class="form-group">
                   <label class="control-label">Descripción</label>
                   <textarea class="form-control" name="descripcion" placeholder="Escribe aqui una descripción del puesto..." id="descripcion"
                   onkeypress="funcionnombre(this.value)">
                     
                   </textarea>
                </div>
                <a href="{{ action('NomencladorController@index') }}" class="btn btn-default" >Cancelar</a>
                 <button type="button" disabled class="btn btn-primary" id="versignombre">Siguiente</button>
  </div>
   <div class="ver-complejidad" class="form-group" style="display:none">
              <div class="form-group">
                <label class="control-label">Preguntas de Complejidad</label>
              </div>
                  <ul class="fa-ul">
                   @foreach($niveles as $niv)
                            <input type="radio" required name="complejidad" id="complej" value="{{$niv->id}}"> {{ $niv->complejidad }}<br>
                            <hr>
                        @endforeach  
                  </ul>     
                  <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
                    <button type="button" class="btn btn-secondary" id="veratrasnombre">Atras</button>
     
                    <button type="button" disabled class="btn btn-primary" id="versigpreg1">Siguiente</button>
                  </div>
            </div>
 <div class="ver-responsabilidad" class="form-group" style="display:none">
              <div class="form-group">
                <label class="control-label">Preguntas de Responsabilidad</label>
              </div>
                  <ul class="fa-ul">
                   @foreach($niveles as $niv)
                            <input type="radio" required name="responsabilidad" id="responsabilidad" value="{{$niv->id}}"> {{ $niv->responsabilidad }}<br>
                            <hr>
                        @endforeach  
                  </ul>     
                  <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
                    <button type="button" class="btn btn-secondary" id="veratraspreg1">Atras</button>
     
                    <button type="button" disabled class="btn btn-primary" id="versigpreg2">Siguiente</button>
                  </div>
            </div>
 <div class="ver-autonomia" class="form-group" style="display:none">
              <div class="form-group">
                <label class="control-label">Preguntas de Autonomía</label>
              </div>
                  <ul class="fa-ul">
                   @foreach($niveles as $niv)
                            <input type="radio" required name="autonomia" id="autonomia" value="{{$niv->id}}"> {{ $niv->autonomia }}<br>
                            <hr>
                        @endforeach  
                  </ul>     
                  <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
                    <button type="button" class="btn btn-secondary" id="veratraspreg2">Atras</button>
     
                    <button type="button" disabled class="btn btn-primary" id="versignivel">Siguiente</button>
                  </div>
            </div>
<div class="ver-nivel" class="form-group" style="display:none">         
                <div class="row col-md-4">
                   <div class="control-label nivel" style="font-size: 16px;">

                  </div>
                   
                </div>
                
                <div class="row col-md-2" style="margin-right: 8px">
                    <label class="control-label">Agrupamientos</label>
                    <select class="form-control agrupamiento" name="agrupamiento" id="agrupamiento">
                      <option value="0">- Select Agrupamiento -</option>
                        
                    </select>
                 
                </div>
                <div class="row col-md-2" style=" margin-right: 8px;">
                    <label class="control-label">Subagrupamiento</label>
                    <select class="form-control subagrupamiento" name="subagrupamiento" id="subagrupamiento" >
                      <option value="0">- Select Subagrupamiento -</option>
                        
                    </select>
                 
                </div>
                  <div class="row col-md-2" style="margin-right: 8px">
                    <label class="control-label">Clasificación</label>
                    <select class="form-control clasificacion" name="clasificacion" id="clasificacion">
                      <option value="0">- Select Clasificación -</option>
                        
                    </select>
                 
                </div>
                <div class="row col-md-2" style=" padding-bottom: 30px;margin-right: 8px">
                    <label class="control-label">Subclasificación</label>
                    <select class="form-control subclasificacion" name="subclasificacion" id="subclasificacion">
                      <option value="0">- Select Subclasificación -</option>
                        
                    </select>
                 
                </div>
              
                <p></p>

      <div class="ver-requisitos" class="form-group" style="display:none"> 
                 
                     <label>Requisitos mínimos</label>
                    <p id="req"></p>
                    <label>Experiencia Laboral</label>
                    <p id="exp" style="margin-bottom: 30px;"></p>
                  
        <div class="row" style="padding: 15px; background-color: rgb(82, 165, 86);">
           <div class="form-group">
             <label style="font-size: 16px; color: #fff;">Condiciones Excluyentes</label>
           </div>
@foreach ($excluyentes as $exclu)
                <div class="row col-md-4" style="margin-bottom: 15px;margin-right: 10px">
                    <label class="control-label">{{ $exclu->nombre }}</label>
                    <select class="form-control condiciones" name="condicion{{ $exclu->id }}" >
                      <option value="Ninguno">- Select -</option>
                      @foreach ($condiciones as $nivel) 
                      @if($exclu->id==1) 
                        @foreach ($organismos as $organ)
                            <option value="{{ $organ->codigo }}">
                                {{ $organ->organismos }}
                            </option>                  
                        @endforeach    
                      @elseif($exclu->id==$nivel->excluyente_id) 
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>  
                          
                      @endif 
                      @endforeach           

                    </select>                 
                </div>                
               
            @endforeach
        </div>
        <input type="text" name="va" value="Condiciones: " id="mostrarcond" style="display:none">
        <input type="text" id="atrascond" style="display:none">
        <a style="cursor: pointer;display:none;" id="atrasc" onclick="funcionatras()">Deshacer</a>
        <a style="cursor: pointer;display:none;" id="limpiarc" onclick="limpiarcondicion()">Limpiar</a>
       </div>
              <div style="margin-top: 10px;">
                
                <a href="{{ action('NomencladorController@index') }}" class="btn btn-default" >Cancelar</a> 
                <button type="button" class="btn btn-secondary" id="veratrasnivel">Atras</button>                
                 <button type="submit" disabled class="btn btn-primary" id="versigagrup">Guardar</button>
              </div>
  </div>

           

                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>
@include('nomenclador.modal')

      
  @endsection

