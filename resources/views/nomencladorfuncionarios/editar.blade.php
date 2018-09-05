@extends('layouts.app')
@section('title', 'Editar puesto')
@section('content')
<div class="row">
    <section class="content">
        <div class="col-md-8 col-md-offset-2">
        
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
           

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <label class="control-label">Editar Puesto del Funcionario</label>
                    </h3>
                </div>
                <div class="panel-body">                    
                  
                        <form method="POST" action="{{ route('nomencladorfuncionarios.update',$preguntas->id) }}"  role="form">
                            {{ csrf_field() }}
                          
                    
                           
                                    <div class="form-group">
                                        <label class="control-label">Nombre del Puesto Funcionario</label>
                                        <input type="text" name="nombre" id="nombre" required class="form-control input-sm" value="{{$preguntas->nombre}}">
                                    </div>
                             <div class="form-group">
                               <label class="control-label">Descripción</label>
                               <textarea class="form-control" name="descripcion" placeholder="Escribe aqui una descripción del puesto..." id="descripcion"
                               onkeypress="funcionnombre(this.value)">
                                 
                               </textarea>
                            </div>
       

                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('nomencladorfuncionarios.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
 
      
  @endsection

