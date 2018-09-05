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
       

 <form role="form" method="POST" action="{{ action('NomencladorfuncionariosController@store') }}">
                {!! csrf_field() !!}

 <div class="ver-nombre" class="form-group" >
                <div class="form-group">
                   <label class="control-label">Nombre del Puesto Funcionario</label>
                   <input type="text" class="form-control" name="nombre" value="" required 
                    id="nombre">
                </div>
                <div class="form-group">
                   <label class="control-label">Descripción</label>
                   <textarea class="form-control" name="descripcion" placeholder="Escribe aqui una descripción del puesto..." id="descripcion"
                   onkeypress="funcionnombre(this.value)">
                     
                   </textarea>
                </div>
                
                <a href="{{ action('NomencladorfuncionariosController@index') }}" class="btn btn-default" >Cancelar</a> 
                             
                 <button type="submit" disabled class="btn btn-primary" id="versigagrup">Guardar</button>
       
  </div>
                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>

  @endsection

