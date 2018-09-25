@extends('layouts.app')
@section('title', 'Crear puesto funcionario')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                  <label class="control-label">Crear Puesto del Funcionario</label>
                  <p id="titulo" style="float: right;"></p>
                </div>


    <div class="panel-body">
       

 <form role="form" method="POST" action="{{ action('NomencladorController@storeF') }}">
                {!! csrf_field() !!}

 <div class="ver-nombre" class="form-group" >
                <div class="form-group col-xs-12 col-sm-12 col-md-12" style="padding-left: 0px;">
                   <label class="control-label">Nombre del Puesto Funcionario</label>
                   <input type="text" class="form-control" name="nombre" required 
                    id="nombre">
                </div>

                <div class="form-group col-md-12" style="padding-left: 0px;">
                   <label class="control-label">Descripción</label>
                   <textarea class="form-control" name="descripcion" placeholder="Escribe aqui una descripción del puesto..." >
                     
                   </textarea>
                </div>
                <div class="form-group row col-md-12">
                <div class="row col-md-6" style="padding-bottom: 10px;">
                    <label class="control-label">Organismos</label>
                    <select class="form-control organismos" name="organismo" id="organismo" required>
                      <option value="">=== Select Organismo ===</option>
                       @foreach ($organismo as $codigo => $organismos)
                            <option value="{{ $codigo }}">
                                {{ $organismos }}
                            </option>                           
                        @endforeach 
                    </select>
                </div>

                <div class="row col-md-6" style="padding-bottom: 10px; padding-left: 50px;">
                    <label class="control-label" id="labelo" style="display:none">Organismos</label>

                  <input type="text" id="atrasorg" style="display:none">
              
                  <a style="margin: 25px;cursor: pointer;display:none;" id="atraso" onclick="funcionatraso()">Deshacer</a>
                  <a style="cursor: pointer;display:none;" id="limpiaro" onclick="limpiarorg()">Limpiar</a>
             <input type="text" name="org" value="" id="mostrarorg" style="display:none">
                 <p id="mostrarorgp"> </p>
                 <p id="atrasorgp" style="display:none"> </p>
                </div>

              </div>
                <a href="{{ action('NomencladorController@indexF') }}" class="btn btn-default" >Cancelar</a> 
                             
                 <button type="submit" class="btn btn-primary">Guardar</button>
       
  </div>
                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>
@include('nomenclador.modal')
  @endsection

