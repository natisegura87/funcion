

<div class="modal fade bd-ver-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Preg</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
     
      <ul class="fa-ul">
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="complejidad"></p></li>
          <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="responsabilidad"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 400;" id="autonomia"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="supervision"></p></li>
          <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="requisitos"></p></li>
        <hr>
        <li><i class="fa-li fa fa-check-square"></i>
          <p style="font-weight: 700;" id="experiencia"></p></li>
        <hr>
      </ul>     
               
      </div>

      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
     
       
      </div>
    </div>
  </div>
</div>

<form role="form" method="POST" action="{{ action('PuestoController@updatePreg') }}">
      {!! csrf_field() !!}
<div class="modal fade bd-editar-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1- Complejidad</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
     
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="complejidad" id="complejidad" value="{{$niv->id}}"> {{ $niv->complejidad }}<br>
                <hr>
            @endforeach     
         </div>
       
     
      </div>
      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
     
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target=".bd-responsabilidad-modal-lg">Siguiente</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-responsabilidad-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">2- Responsabilidad</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
     
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="responsabilidad" id="responsabilidad" value="{{$niv->id}}"> {{ $niv->responsabilidad }}<br>
                <hr>
            @endforeach     
         </div>
       
      
      </div>
      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-complejidad-modal-lg" data-dismiss="modal">Atras</button>   
       
        <buttontype="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-autonomia-modal-lg">Siguiente</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-autonomia-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">3- Autonomía</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
    
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="autonomia" id="autonomia" value="{{$niv->id}}"> {{ $niv->autonomia }}<br>
                <hr>
            @endforeach     
         </div>
       
       
      </div>

      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
         
        
        <a href="{{ action('PuestoController@index') }}" class="btn btn-default" >Cancelar</a> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Atras</button>    
       
         <button name="guardar" class="btn btn-success guardar" title=" Ver " type="submit" onclick="return confirm('Deseas guardar ?');">Guardar</button>

          
      </div>
    </div>
  </div>
</div>
 </form>


 <form role="form" method="POST" action="{{ action('PuestoController@updatePreg') }}">
      {!! csrf_field() !!}
<div class="modal fade bd-complejidad-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">1- Complejidad</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
     
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="complejidad" id="complejidad" value="{{$niv->id}}"> {{ $niv->complejidad }}<br>
                <hr>
            @endforeach     
         </div>
       
     
      </div>
      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
     
        <button id="sigcomplejidad" disabled type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target=".bd-responsabilidad-modal-lg">Siguiente</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-responsabilidad-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">2- Responsabilidad</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
     
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="responsabilidad" id="responsabilidad" value="{{$niv->id}}"> {{ $niv->responsabilidad }}<br>
                <hr>
            @endforeach     
         </div>
       
      
      </div>
      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bd-complejidad-modal-lg" data-dismiss="modal">Atras</button>   
       
        <button id="sigresponsabilidad" disabled type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-autonomia-modal-lg">Siguiente</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-autonomia-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    
    <div class="modal-content">
        <div class="modal-header" style="background-color: #6aa4c5;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">3- Autonomía</h4>
        </div>
     
      <div class="modal-body" style="padding-bottom: 0px;">
    
       
         <div class="form-group">
           @foreach($niveles as $niv)
                <input type="radio" required name="autonomia" id="autonomia" value="{{$niv->id}}"> {{ $niv->autonomia }}<br>
                <hr>
            @endforeach     
         </div>
       
       
      </div>

      <div class="modal-footer" style="border-top: 1px solid #f5f5f500; padding-top: 0px;">
         
        
        <a href="{{ action('PuestoController@index') }}" class="btn btn-default" >Cancelar</a> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Atras</button>    
       
         <button id="sigautonomia" name="guardar" disabled class="btn btn-success guardar" title=" Ver " type="submit" onclick="return confirm('Deseas guardar ?');">Guardar</button>

          
      </div>
    </div>
  </div>
</div>
 </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


    $("#sigcompl").click(function(){
        $("#sigresp").modal({backdrop: true});
    });
    $("#sigresponsabilidad").click(function(){
        $("#sigautonomia").modal({backdrop: false});
    });
    $("#myBtn3").click(function(){
        $("#myModal3").modal({backdrop: "static"});
    });


  $('input#complejidad').on('click change', function(e) {
       
       $('#sigcomplejidad').attr('disabled', false);

  })
  $('input#responsabilidad').on('click change', function(e) {
       
       $('#sigresponsabilidad').attr('disabled', false);
        
  })
  $('input#autonomia').on('click change', function(e) {
       console.log("Hola");
       $('#sigautonomia').attr('disabled', false);
  })
 
      
      setTimeout(function() {
           $("#alert").fadeOut();           
      },2000);


</script>
