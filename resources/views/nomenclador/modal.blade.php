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
      $('#versigagrup').attr('disabled', true);
      $('.ver-requisitos').hide();
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
      $('.ver-requisitos').show();

      var agrup = $(this).val();
      var div = $(this).parent().parent();


      var url1 = '{{ route('nomenclador.getsubagrup') }}';

        var ag= " ";
        $.ajax({
            type:'get',
            url:url1,
            data:{'agrupamiento':agrup
                 
            }, 
            success:function(data){
                console.log('success Sub');
                console.log(data);
                ag+='<option value="">-Select Subagrupamiento-</option>';
                for (var i=0;i<data.length;i++){
                    ag+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
       
                //console.log(op);
                div.find('.subagrupamiento').html(" ");
                div.find('.subagrupamiento').append(ag);
            },
            error:function(error){
                console.log('error subagrupamiento');
                alert(error);
            }
        });

     
    });

  $(document).on('change','.clasificacion',function(){  
      console.log("clasificacion ver"); 

      var clasi = $(this).val();
      var div = $(this).parent().parent();


      var url1 = '{{ route('nomenclador.getsubclasif') }}';

        //'http://localhost/intranet/public/uploadFile';
        var ag= " ";
        $.ajax({
            type:'get',
            url:url1,
            data:{'clasificacion':clasi
                 
            }, 
            success:function(data){
                console.log('success clasi');
                console.log(data);
                ag+='<option value="">-Select Subclasificacion-</option>';
                for (var i=0;i<data.length;i++){
                    ag+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
       
                //console.log(op);
                div.find('.subclasificacion').html(" ");
                div.find('.subclasificacion').append(ag);
            },
            error:function(error){
                console.log('error subclasificacion');
                alert(error);
            }
        });

     
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
                  op+='<input type="number" style="display:none;" name="nivel" value="'+data.id+'"><p><strong> Nivel </strong>'+data.nombre+'</p>';
                  //console.log(op);
                  if(data.id==7){
                    op+='<input type="checkbox" name="gente" disabled> Tiene gente a cargo';
                  }else{
                    op+='<input type="checkbox" name="gente"> Tiene gente a cargo';
                  }
                  div.find('.nivel').html(" ");
                  div.find('.nivel').append(op);
                  //     
                  div.find('#req').html(" ");
                  div.find('#exp').html(" ");            
                  div.find('#req').append(data.requisitos);                 
                  div.find('#exp').append(data.experiencia);
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

function funcionnombre($texto){

  cant= $texto.length;
  if(cant > 35){
    console.log("entroee");
    console.log($texto);
    $('#versignombre').attr('disabled', false);
  }   
   
   nombre = document.getElementById("nombre").value;  
   document.getElementById("titulo").innerHTML = nombre;
}

function funcionatras(){
   console.log("entro atras");
    var v= document.getElementById("atrascond").value;
    document.getElementById("mostrarcond").value = v;
}

function limpiarcondicion(){
   console.log("entro limpiar");    
    document.getElementById("mostrarcond").value = "Condiciones: ";
}


$(document).on('change','.condiciones',function(){        
   var condic_id = $(this).val();
   console.log(condic_id);
   console.log("entro cond");
   $('#mostrarcond').show();
   $('#atrasc').show();
   $('#limpiarc').show();

  var v= document.getElementById("mostrarcond").value;
  document.getElementById("mostrarcond").value += condic_id + " "; 
  console.log(v);
  document.getElementById("atrascond").value = v; 

    })
   
</script>