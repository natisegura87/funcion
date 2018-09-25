
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

var seleuni= " ";

$(document).ready(function(){
    var regimen="1";
    var organismo="0";
    $(document).on('change','.regimen',function(){        
        regimen = $(this).val();   
        console.log('regimen'); console.log(regimen);  
        var div = $(this).parent().parent().parent();
        var url = '{{ route('vincularpuesto.get') }}';

        seleuni= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':regimen},
            success:function(data){
                //console.log('success');

                //console.log(data);
                seleuni+='<option value="">=== Select Unidad ===</option>';
                for (var i=0;i<data.length;i++){
                    seleuni+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
                }
                //console.log(op);
                div.find('.unidad').html(" ");
                div.find('.unidad').append(seleuni);
            },
            error:function(){
                
            }
        });

        var url1 = '{{ route('vincularpuesto.getP') }}';

        var op1= " ";
        $.ajax({
            type:'get',
            url:url1,
            data:{'regimen':regimen,
                  'organismo':organismo
                },
            success:function(data){
                //console.log('success');

                //console.log(data);
                op1+='<option value="">=== Select Puesto ===</option>';
                /*var keys = Object.keys(data);

                for (var i=0;i<keys.length;i++){
                    var key = keys[i];
                    op1+='<option value="'+key+'">'+data[key]+'</option>';
                }*/

                for (var i=0;i<data.length;i++){
                    op1+='<option value="'+data[i].id+'">'+data[i].nombrepuesto+'</option>';
                }

                //console.log(op1);
                div.find('.puesto').html(" ");
                div.find('.puesto').append(op1);
            },
            error:function(){
                
            }
        });

    })
    
    var unid="1";
    console.log('regimen'); console.log(regimen); 

    $(document).on('change','.organismo',function(){        
        organismo = $(this).val();
         var div = $(this).parent().parent().parent();
         console.log('regimen o'); console.log(regimen); 
        console.log(organismo);
        var url = '{{ route('vincularpuesto.getO') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";

        div.find('.unidad').html(" ");
        div.find('.unidad').append(seleuni);

        $.ajax({
            type:'get',
            url:url,
            data:{'regimen':regimen,
                'organismo':organismo
                },

            success:function(data){
                //console.log(data);
        
                //console.log(data[0]);
                if(data.length){
                    op+='<option value="">=== Select Puesto ===</option>';             
                }                  
                else{
                    $("select#puestoD").css("color", "#f70e0a");
                    $("select#puestoD").css("font-size", "18px");
                    op+='<option value="">- No hay puestos cargados -</option>';
                }
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].nombrepuesto+'</option>';
                }
                //console.log(op);
                div.find('.puesto').html(" ");
                div.find('.puesto').append(op);

                div.find('.puestoDep').html(" ");
                div.find('.puestoDep').append('<option value="">=== Select Puesto ===</option>');

              
            },
            error:function(){
                
            }
        });

    })

    $(document).on('change','.unidad',function(){        
        unid = $(this).val();
        //console.log(unidad_id);
        var div = $(this).parent().parent().parent();
        //console.log("hola");
        var url = '{{ route('vincularpuesto.getD') }}';
        //'http://localhost/intranet/public/uploadFile';
        var op= " ";
        $.ajax({
            type:'get',
            url:url,
            data:{'id':unid,
                'organismo':organismo
                },

            success:function(data){
                console.log('ver');
           
                console.log(organismo);
                if(data.length)
                  op+='<option value="">=== Select Puesto ===</option>';
                else
                  op+='<option value="">=== No hay puestos cargados ===</option>';
                for (var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].nomenclador_id+'">'+data[i].puesto_name+'</option>';
                }
                //console.log(op);
                div.find('.puestoDep').html(" ");
                div.find('.puestoDep').append(op);
            },
            error:function(){
                
            }
        });

    })

    $("p").click(function(){
        $(this).hide();
    });
});

$(document).ready(function(){
    $("select").focus(function(){
       $("select#puestoD").css("color", "#555");
       $("select#puestoD").css("font-size", "14px");
        
    });
});
  </script>