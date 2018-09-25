<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
        <link rel="shortcut icon" href="{{ asset('images/logo-sistema.png') }}" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Ingresar</a>
                        <a href="{{ route('register') }}">Registrarse</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="color: #0fab46;
    font-family: -webkit-body;">
                    Carrera Administrativa<br>Ley 3487
                </div>
                <div class="subtitle m-b-md" style="color: #0fab46;
    font-family: -webkit-body;font-size: 30px;">
    Software Orientativo para la confección del Nomenclador de Puestos y <br>de la Estructura Organizativa
</div>

                <div class="links">                   
                    <a href="{{ route('nomenclador.index') }}">Nomenclador</a>
                    
                    <a href="{{ route('vincularpuesto.index') }}">Organigrama</a>
                    <a href="{{ route('organigrama.indexN') }}">Graficar Organigrama</a>
                   
                </div>
            </div>
        </div>
    </body>
</html>
