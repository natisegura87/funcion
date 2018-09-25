@extends('layouts.app')
@section('title', 'Vincular Puestos')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">
                <label class="control-label">Crear Vinculo de Puestos</label>

                 </div>


    <div class="panel-body">
     
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form role="form" method="POST" action="{{ action('VincularpuestoController@store') }}">
                {!! csrf_field() !!}

          
<div class="form-group col-md-12" style="background-color: #52a556;border-radius: 5px;">
            <div class="row col-md-6" style="padding: 10px">
                    <label class="control-label">Regimen</label>
                    <select class="form-control regimen" name="regimen" id="regimen" required>
                      <option value="">=== Select Regimen ===</option>
                       @foreach ($regimen as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-6" style="padding-top: 10px; margin-left: 30px;">
                    <label class="control-label">Organismos</label>
                    <select class="form-control organismo" name="organismo" id="organismo" required>
                      <option value="0">=== Select Organismo ===</option>
                       @foreach ($organismos as $organ)
                            <option value="{{ $organ->codigo }}">
                                {{ $organ->organismos }}
                            </option>                  
                        @endforeach    
                    </select>
                </div>
        </div>
                <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nombre del Puesto</label>
                    <select class="form-control puesto" name="puesto" id="puesto" required>
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Localidades</label>
                    <select class="form-control localidad" name="localidad" id="localidad" required>
                      <option value="">=== Select Localidad ===</option>
                         @foreach ($localidad as $nivel)
                            <option value="{{ $nivel->id }}">
                                {{ $nivel->nombre }}
                            </option>                           
                        @endforeach
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-bottom: 10px">
                    <label class="control-label">Nivel de la estructura (Unidades)</label>
                    <select class="form-control unidad" name="uni" id="unidad" required>
                      <option value="">=== Select Unidad ===</option>
                        
                    </select>
                </div>
                 <div class="row col-md-6" style="margin-left: 20px;margin-bottom: 10px">
                    <label class="control-label">Puesto del que depende</label>
                    <select class="form-control puestoDep" name="dep" id="puestoD" 
                    required >
                      <option value="">=== Select Puesto ===</option>
                        
                    </select>
                </div>
        <div class="col-xs-12 col-sm-12 col-md-12">        
            <input type="checkbox" name="vacante"> Genera vacante
        </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Guardar</button>
                <a href="{{ action('VincularpuestoController@index') }}" class="btn btn-default" style="margin-top: 20px;">Cancelar</a>
            </div>

                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>

@include('vincularpuesto.modal')
      
  @endsection

