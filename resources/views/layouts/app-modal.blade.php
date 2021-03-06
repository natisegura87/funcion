
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('New message to ' + recipient)
          modal.find('.modal-body .name').val(recipient)
        })
        var id;
        var nombre;
        $('.bd-ver-modal-lg').on('show.bs.modal', function (event) {
     
          var button = $(event.relatedTarget) // Button that triggered the modal
          nombreV = button.data('ver') // Extract info from data-* attributes
       
          complejidad = button.data('complejidad')
          console.log(complejidad);
          responsabilidad = button.data('responsabilidad')
          autonomia = button.data('autonomia')

          supervision = button.data('supervision')         
          requisitos = button.data('requisitos')
          experiencia = button.data('experiencia')

          var modal = $(this)
          modal.find('.modal-title').text('Preguntas ' + nombreV)   
          modal.find('.modal-body #complejidad').text('COMPLEJIDAD: ' + complejidad)
          modal.find('.modal-body #responsabilidad').text('RESPONSABILIDAD: ' + responsabilidad)
          modal.find('.modal-body #autonomia').text('AUTONOMIA: ' + autonomia) 
          modal.find('.modal-body #supervision').text('SUPERVISION: ' + supervision)
          modal.find('.modal-body #requisitos').text('REQUISITOS: ' + requisitos)
          modal.find('.modal-body #experiencia').text('EXPERIENCIA LABORAL: ' + experiencia)
        })

         $('.bd-editar-modal-lg').on('show.bs.modal', function (event) {
     
          var button = $(event.relatedTarget) // Button that triggered the modal
          nombreE = button.data('ver') // Extract info from data-* attributes
       
          complejidad = button.data('complejidad')
          console.log(complejidad);
          responsabilidad = button.data('responsabilidad')
          autonomia = button.data('autonomia')

          supervision = button.data('supervision')         
          requisitos = button.data('requisitos')
          experiencia = button.data('experiencia')

          var modal = $(this)
          modal.find('.modal-title').text('Editar Nivel ' + nombreE)   
          modal.find('.modal-body #complejidad').text('COMPLEJIDAD: ' + complejidad)
          modal.find('.modal-body #responsabilidad').text('RESPONSABILIDAD: ' + responsabilidad)
          modal.find('.modal-body #autonomia').text('AUTONOMIA: ' + autonomia) 
          modal.find('.modal-body #supervision').text('SUPERVISION: ' + supervision)
          modal.find('.modal-body #requisitos').text('REQUISITOS: ' + requisitos)
          modal.find('.modal-body #experiencia').text('EXPERIENCIA LABORAL: ' + experiencia)
        })

        $('.bd-ver-agrup-modal-lg').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          nombreE = button.data('ver') // Extract info from data-* attributes

          agrupamiento = button.data('agrupamiento')
          console.log(agrupamiento);
          subagrupamiento = button.data('subagrupamiento')
          clasificacion = button.data('clasificacion')
          subclasificacion = button.data('subclasificacion')   

          var modal = $(this)
          modal.find('.modal-title').text('Agrupamiento y clasificación ' + nombreE)   
          modal.find('.modal-body #agrupamiento').text('AGRUPAMIENTO: ' + agrupamiento) 
          modal.find('.modal-body #subagrupamiento').text('SUB-AGRUPAMIENTO: ' + subagrupamiento) 
          modal.find('.modal-body #clasificacion').text('CLASIFICACIÓN: ' + clasificacion) 
          modal.find('.modal-body #subclasificacion').text('SUB-CLASIFICACIÓN: ' + subclasificacion) 
       
        })

    $('.bd-ver-cond-modal-lg').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          nombreE = button.data('ver') // Extract info from data-* attributes
          excluyentes = button.data('excluyentes')
         
          cond = button.data('idcond')
          org = button.data('idorg')

          var label='';
          var modal = $(this)
          modal.find('.modal-title').text('Condiciones Excluyentes ' + nombreE) 
          modal.find('.modal-body').html(" ")  
          modal.find('.modal-body').append(label);

          var url = '{{ route('nomenclador.getcondiciones') }}';     
     
          $.ajax({
            type:'get',
            url:url,
            data:{'condiciones':cond,
                 
            },
            success:function(data){
                console.log('success 1');
            label+='<label style="font-size: 16px;color: #3eabe2;">Condiciones</label><br>';
            modal.find('.modal-body').append(label);
            label='';
            for (var i = 0; i < data.length; i++) {
             var xx=data[i];
            // console.log(xx);  
              for (var j = 0; j < xx.length; j++) {
              // console.log(xx[j].nombre);  
                  for (var k = 0; k < excluyentes.length; k++) {
                      //console.log(excluyentes[k].nombre);           
     
                       if(excluyentes[k].id==xx[j].excluyente_id){
                        //console.log(xx[j].excluyente_id);
                        label+='<strong>'+excluyentes[k].nombre+'</strong><p>'+xx[j].nombre +'</p>';
                         }   
                       }
                     
             }

           }
           modal.find('.modal-body').append(label);
                        label='  <hr>';
               
            },
            error:function(error){
                console.log('error condiciones');
                alert(error);
            }
        });
   

        var url1 = '{{ route('nomenclador.getorganismos') }}';

          $.ajax({
            type:'get',
            url:url1,
            data:{
                  'organismos':org
            },
           success:function(data){
                console.log('success 2');
            label+='<label style="font-size: 16px;color: #3eabe2;">Organismos</label>';
            modal.find('.modal-body').append(label);
            label='';
            //console.log(data);  
            for (var i = 0; i < data.length; i++) {
             var xx=data[i];
            // console.log(xx);  

              for (var j = 0; j < xx.length; j++) {
              // console.log(xx[j].organismos);  
              label+='<p>'+xx[j].organismos +'</p>';
             
             }
             
           }
        
            modal.find('.modal-body').append(label);
            label='  <hr>';               
            },
            error:function(error){
                console.log('error organismos');
                alert(error);
            }
        });

        })


        $('.bd-complejidad-modal-lg').on('show.bs.modal', function (event) {
     
          var button = $(event.relatedTarget) // Button that triggered the modal
          nombre = button.data('complejidad') // Extract info from data-* attributes
          id = button.data('idcomplejidad')
          console.log(id);
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('1- Complejidad ' + nombre)    
        })

        $('.bd-responsabilidad-modal-lg').on('show.bs.modal', function (event) {   
          var modal = $(this)
          modal.find('.modal-title').text('2- Responsabilidad ' + nombre)      
        })

        $('.bd-autonomia-modal-lg').on('show.bs.modal', function (event) {      
          var modal = $(this)        
          modal.find('.modal-title').text('3- Autonomía ' + nombre)    
          modal.find('.modal-footer .guardar').val(id)
        })


    </script>

