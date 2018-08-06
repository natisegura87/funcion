@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                 @yield('pregunta')
             <div class="panel-heading">Responda las preguntas</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    OK!
                    
                     
                    <p></p>
                  <p id="lista"></p>

                    <?php //$e= htmlentities($comienzo) ?>
                    <button type="button" onclick="mlista(3)">Lista</button>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        
                    </tr>
                 </thead>
                    <tbody>
             
                   
                     @foreach($unidades as $uni)
                        <tr>
                            <td>{{ $uni->id }}</td>
                      
                            <td>{{ $uni->nombre }}</td>
                        </tr>
                    @endforeach
                     </tbody>
                </table>

       

                </div>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection