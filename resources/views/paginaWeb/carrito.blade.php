@extends('layouts.app')

@section('title', 'Carrito')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
      <strong>
        <a href="/ventas">
          <span class="glyphicon glyphicon-remove rojo"></span>
        </a>{{ Session::get('mensaje') }}  
      </strong>
    </p>                
@endif

  <div class="content">
    <div class="container-fluid">
      <div class="row">
      </div>
    </div>
  </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--   Core JS Files   -->
<script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>


@endsection