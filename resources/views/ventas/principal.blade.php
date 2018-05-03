<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <link rel="shortcut icon" href="{{ asset('img/favicon/cheap_JXp_1.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon/cheap_JXp_1.ico') }}" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  CSS estilos propios     -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('recursos/css/bootstrap.min.css')}}" rel="stylesheet" />

    <title>@yield('title') -La Oaxaqueña</title>

  </head>
  
    

  <body>
  	<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">VENTAS</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown  bg-danger" style="margin-top: 2px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Cancelaciones <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="listadoCancelarVenta">Cancelar Venta</a></li>
          <li class="divider"></li>
          <li><a href="listadoCancelarP">Cancelar Producto</a></li>
        </ul>
      </li>
    </ul>
 
    <ul class="nav navbar-nav navbar-right ">
            @guest
                <li><a class="nav-link" href="/logueo"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
            @else
                <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                
                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="btn btn-danger dropdown-item separador" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>
                    <p class="dropdown-item "></p>
                    <a class="btn btn-success dropdown-item" href="/home">Sistema</a>
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
  </div>
</nav>
    @yield('contenido');
  </body>
</html>

