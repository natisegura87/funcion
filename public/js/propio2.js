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
                  op+='<input type="number" style="display:none;" name="nivel" value="'+data.id+'"><p><strong> Nivel </strong>'+data.nombre+'</p>';
                  //console.log(op);
                  if(data.id==7){
                    op+='<input type="checkbox" name="gente" disabled> Tiene gente a cargo';
                  }else{
                    op+='<input type="checkbox" name="gente"> Tiene gente a cargo';
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

function funcionnombre($nombre){
   console.log("entro");
   $('#versignombre').attr('disabled', false);
   document.getElementById("titulo").innerHTML = $nombre;
}