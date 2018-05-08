<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!--<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('') }}">-->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - "La Oaxaqueña"</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    
  <link rel="stylesheet" href=" {{ asset('recursos/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href=" {{ asset('css/style.css')}}">  

  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('recursos/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  
</head>
<body class="my-body">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Acerca de</a></li>
        <li><a href="/webProductos"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge" id="etiCant2"></span> Productos</a></li>
        <!--<li><a href="/mostrarCar"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a></li>-->
        <li><a href="#"><span class="glyphicon glyphicon-earphone"></span> Contacto</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
            @guest
                <li><a class="nav-link" href="/logueo"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
            @else
                <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="btn btn-danger dropdown-item separador" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>
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
  </div>
</nav>


<div class="container">
            @yield('content')
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!-- App scripts -->
        @stack('scripts')

<footer class="container-fluid text-center footer_m">
  <p>Footer Text</p>
</footer>
<script type="text/javascript">
    $(function(){
      var current_page_URL = location.href;
      $( "a" ).each(function() {
         if ($(this).attr("href") !== "#") {
           var target_URL = $(this).prop("href");
           if (target_URL == current_page_URL) {
              $('nav a').parents('li, ul').removeClass('active');
              $(this).parent('li').addClass('active');
              return false;
           }
         }
      });
    });

    if (sessionStorage.getItem('cantidad')==null || sessionStorage.getItem('cantidad')==0 ||sessionStorage.getItem('cantidad')=='0') {
    }else{
      document.getElementById('etiCant2').innerHTML = sessionStorage.getItem('cantidad');
    }
    
</script>
</body>
</html>

