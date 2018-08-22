
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
          modal.find('.modal-title').text('Editar Preguntas ' + nombreE)   
          modal.find('.modal-body #complejidad').text('COMPLEJIDAD: ' + complejidad)
          modal.find('.modal-body #responsabilidad').text('RESPONSABILIDAD: ' + responsabilidad)
          modal.find('.modal-body #autonomia').text('AUTONOMIA: ' + autonomia) 
          modal.find('.modal-body #supervision').text('SUPERVISION: ' + supervision)
          modal.find('.modal-body #requisitos').text('REQUISITOS: ' + requisitos)
          modal.find('.modal-body #experiencia').text('EXPERIENCIA LABORAL: ' + experiencia)
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

