        <nav class="navbar navbar-light navbar-default navbar-static-top navbar-expand-lg  bg-light">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div> 

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                     
                       
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nomenclador <span class="caret"></span></a>
                           
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('nomenclador.index') }}">Empleados</a></li>
                            <li><a href="{{ route('nomencladorfuncionarios.index') }}">Funcionarios</a></li>                           
                            
                          </ul>
                        </li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Organigrama <span class="caret"></span></a>
                           
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('vincularpuesto.index') }}">Puestos</a></li>
                            <li><a href="{{ route('vincularpuesto.create') }}">Vincular Puestos</a></li>
                           
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('organigrama.indexN') }}">Graficar</a></li>
                          </ul>
                        </li>
                        @guest
                            <li style="border: 1px solid rgb(67, 156, 72)"><a href="{{ route('login') }}">Ingresar</a></li>
                            <li style="border: 1px solid rgb(67, 156, 72)"><a href="{{ route('register') }}">Registrarse</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>