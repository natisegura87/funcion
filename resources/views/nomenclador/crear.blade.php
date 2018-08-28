@extends('layouts.app')
@section('title', 'Crear puesto')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <label class="control-label">Crear Puesto del Nomenclador</label>
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
                   onfocus="this.value=''" placeholder="Nombre" id="nombre" onchange="funcionnombre()">
                </div>
                <div class="form-group">
                   <label class="control-label">Descripción</label>
                   <textarea class="form-control" onfocus="this.value=''" name="descripcion">Escribe aqui una descripción del puesto...</textarea>
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
                <div class="row col-md-6">
                   <div class="control-label nivel" style="font-size: 16px;">

                  </div>
                   
                </div>
                
                <div class="row col-md-6" style="margin-bottom: 30px">
                    <label class="control-label">Agrupamientos</label>
                    <select class="form-control agrupamiento" name="agrupamiento" id="agrupamiento" required>
                      <option value="0">=== Select Agrupamiento ===</option>
                        
                    </select>
                </div>
                <a href="{{ action('NomencladorController@index') }}" class="btn btn-default" >Cancelar</a>
                 <button type="button" disabled class="btn btn-primary" id="versigagrup">Siguiente</button>
  </div>
           

                              
        </form>
       
    </div>

            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

  $('#nombre').change(function(e) {       
       $('#versignombre').attr('disabled', false);
  })

      
      setTimeout(function() {
           $("#alert").fadeOut();           
      },2000);
      
$(document).ready(function(){

    

    $("#versignombre").click(function(){      
      //console.log("nombre");
      $('.ver-complejidad').show(); //muestro mediante id
      $('.ver-nombre').hide(); //oculto
    });
    //
    $("#veratrasnombre").click(function(){      
      //console.log("atras");
      $('.ver-complejidad').hide(); //muestro mediante id
      $('.ver-nombre').show(); //oculto
    });
    var preg1,preg2,preg3,nivel;
    $('input#complej').on('click change', function(e) {    
      //console.log("complejidad"); 
      preg1 = $(this).val();
      console.log(preg1);
      console.log("hola1");  
       $('#versigpreg1').attr('disabled', false);
    });

       //
    $("#versigpreg1").click(function(){      
     // console.log("res");
     console.log(preg1);
     console.log("nive");  
      $('.ver-responsabilidad').show(); //muestro mediante id
      $('.ver-complejidad').hide(); //oculto
    });
    $("#veratraspreg1").click(function(){      
      //console.log("atras 1");
      $('.ver-responsabilidad').hide(); //muestro mediante id
      $('.ver-complejidad').show(); //oculto
    });
    $('input#responsabilidad').on('click change', function(e) {    
      //console.log("responsabilidad");  
      preg2 = $(this).val(); 
       $('#versigpreg2').attr('disabled', false);
      });
     //
    $("#versigpreg2").click(function(){      
      //console.log("autonomia");
     
      $('.ver-autonomia').show(); //muestro mediante id
      $('.ver-responsabilidad').hide(); //oculto
    });
    $("#veratraspreg2").click(function(){      
      //console.log("atras 2");
      $('.ver-autonomia').hide(); //muestro mediante id
      $('.ver-responsabilidad').show(); //oculto
    });
    $('input#autonomia').on('click change', function(e) {    
      //console.log("autonomia");   
      preg3 = $(this).val();
       $('#versignivel').attr('disabled', false);
    });
     //
    $("#veratrasnivel").click(function(){      
      //console.log("atras n");
      $('.ver-nivel').hide(); //muestro mediante id
      $('.ver-complejidad').show(); //oculto
    });


    $("#versignivel").click(function(){      
      //console.log("res");
      $('.ver-nivel').show(); //muestro mediante id
      $('.ver-autonomia').hide(); //oculto
      $('.cartel').hide();

    });

  $(document).on('change','.agrupamiento',function(){  
      console.log("agrupamiento ver"); 
      $('#versigagrup').attr('disabled', false);

     
    });

 $("#versignivel").click(function(){             
        
        console.log("nivel");
        //console.log(preg1);
        //console.log(preg2);
        //console.log(preg3);
        var div = $(this).parent().parent().parent();
        //console.log("hola");
        
        var url = '{{ route('nomenclador.getnivel') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        //console.log(op);
        $.ajax({
            type:'get',
            url:url,
            data:{'complejidad':preg1,
                  'responsabilidad':preg2,
                  'autonomia':preg3
            },
            success:function(data){
               // console.log('success');
               // console.log(data);
               if(data.id>0){
                nivel=data.id;
                  op+='<p name="nivel" id="'+data.id+'"><strong> Nivel </strong>'+data.nombre+'</p>';
                  //console.log(op);
                  if(data.id==7){
                    op+='<input type="checkbox" name="gente" disabled value="0"> Tiene gente a cargo';
                  }else{
                    op+='<input type="checkbox" name="gente" value="0"> Tiene gente a cargo';
                  }
                  div.find('.nivel').html(" ");
                  div.find('.nivel').append(op);
               }else{
                  alert("Inconsistencia en los niveles");
                  $('.ver-complejidad').show(); 
                  $('.ver-nivel').hide(); 
                  $('.cartel').show();
                 
                  var car="Inconsistencia entre los niveles, vuelva a contestar las preguntas";
                  div.find('.alertc').html(" ");
                  div.find('.alertc').append(car);
               }       
        

        var url1 = '{{ route('nomenclador.getagrup') }}';
        //'http://localhost/intranet/public/uploadFile';
        var ag= " ";
        console.log("viedno");
        console.log(nivel);
        $.ajax({
            type:'get',
            url:url1,
            data:{'nivel':nivel
                  
            },
            success:function(data){
                console.log('success A');
                console.log(data);
                ag+='<option value="">=== Select Agrupamiento ===</option>';
                for (var i=0;i<data.length;i++){
                    ag+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
       
                //console.log(op);
                div.find('.agrupamiento').html(" ");
                div.find('.agrupamiento').append(ag);
            },
            error:function(error){
                console.log('error agrupamiento');
                alert(error);
            }
        });


            },
            error:function(error){
                console.log('error nivel');
                alert(error);
            }
        });

    })
   
});

function funcionnombre(){
   console.log("entro");
   $('#versignombre').attr('disabled', false);
}
   
</script>

      
  @endsection

