<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="/home"><i class="ti-panel"></i> Principal</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>-->
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    <p>Productos</p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="/listaProductos">Visualizar</a></li>
                                <li><a href="/formProducto">Agregar</a></li>
                                <li><a href="/listaModificar">Modificar</a></li>
                                <li><a href="/entradaProducto">Entradas</a></li>
                                <li><a href="#">Salidas</a></li>
                                <li><a href="/listadoEliminar">Eliminar</a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-list-alt"></span>
									<p>Usuarios</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="/lista_usuarios">Visualizar</a></li>
                                <li><a href="/formulario_usuario">Agregar</a></li>
                                <li><a href="/datos_usuarios">Modificar</a></li>
                                <li><a href="/datos_usuarios2">Eliminar</a></li>
                              </ul>
                        </li>
						<!--<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>-->

                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="btn btn-danger dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li>
                                <div class="div-avatar">
                                    <img src="{{ asset('img/usuarios/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar" title="{{ Auth::user()->name }}">
                                </div>
                            </li>
                                
                        @endguest
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                    </ul>

                </div>
            </div>
        </nav>