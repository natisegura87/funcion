@extends('layouts.app')

@section('content')

     <div class="panel-heading">Responda las preguntas</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="panel-heading">
<p id="demo"> Nuevo </p>
<button type="button" onclick="mostrar()">click cambio texto</button>
<button type="button" onclick="limpiar()">limpiar</button>
<p id="ver"> VER </p>

<button type="button" onclick="mostrarVer()">mostrar VER</button>
</div>

<div class="column-3">
<form>
	<select class="form-control" id="sel1" onchange="cartel()">
	    <option selected="true" disabled="disabled">Seleccione cartel</option>
	    <option>Licencia</option>
	    <option>Vacante</option>
	    
  	</select>
</form>
</div>

<div class="column-3">
<form>
	<select class="form-control" id="sel" onchange="mostrar()">
	    <option selected="true" disabled="disabled">Seleccione texto</option>
	    <option>Licencia</option>
	    <option>Vacante</option>
	    
  	</select>
</form>
</div>

<div class="column-3">
<form>
	<select class="form-control" id="selec" onchange="seleccionado()">
	    <option selected="true" disabled="disabled">Seleccione opcion</option>
	    <option value="1">Licencia</option>
	    <option value="2">Vacante</option>
	    
  	</select>
</form>
</div>
<div class="row" style="padding: 10px 15px">
  <div class="column">
   <div class="w3-container" style="padding: 0px;">
<div class="form-group">
  <label for="sel1">Empleado que ocupa el puesto:</label>
    <select class="form-control" id="leg" onchange="mostrarLeg()">
	    <option selected="true" disabled="disabled">Seleccione legajo</option>
	    <option>Licencia</option>
	    <option>Vacante</option>
	    
  	</select>
</div>
</div>
</div>
  <div class="column">
  	<label for="sel1">Empleado que ocupa el puesto:</label>
  	<p id="empleado"> Empleado </p>
  </div>
</div>
                    
                </div>
            </div>
@endsection


