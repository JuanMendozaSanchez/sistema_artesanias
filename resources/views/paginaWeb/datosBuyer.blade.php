@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

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
        <div class="alert alert-info alert-dismissible text-center" style="font-size: 1.5rem;">
          <a class="close" data-dismiss="alert" aria-label="close" style="font-weight: bold;font-size:2rem;">&times;</a>
          <strong>Aviso!</strong> Para evitar errores durante el envío ingrese sus datos correctos<strong> (solo en caso de ser necesario).</strong>
            <p>Si todo esta correcto presione el boton <strong>finalizar.</strong></p>
        </div>
        <div class="col-md-6">
          <h3 class="text-center">Artículos</h3>
          <div class="table-responsive">  
            <table class="table table-condensed ">
              <thead>
                <tr >
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
                @for($i=0;$i < count($articulos->articulo);$i++)
                  @if($articulos->articulo[$i]!=null)
                    <tr>
                      <th>{{ $articulos->articulo[$i]->nombre }}</th>
                      <th>{{ $articulos->articulo[$i]->cantidad }}</th>
                      <th>{{ $articulos->articulo[$i]->precio }}</th>
                    </tr>
                  @endif
                @endfor
              </tbody>
            </table>
            <div class="alert alert-success text-right">
              <p style="font-size:2rem;"><strong>Total: {{ $total }}</strong></p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <h3 class="text-center">Datos del Comprador</h3>
          <form method="post" action="">
            <div class="form-group col-md-6">
              <label>Nombre:</label>
              <input type="text" required name="nombreCliente" value="{{ $datosCliente->shipping_address->recipient_name }}" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Correo:</label>
              <input type="email" required name="correoCliente" value="{{ $datosCliente->email }}" class="form-control">
            </div>
            <div class="form-group col-md-12">
              <label>Calle y Número:</label>
              <input type="text" required name="calleCliente" value="{{ $datosCliente->shipping_address->line1 }}" class="form-control">
            </div>
            <div class="form-group col-md-12">
              <label>Colonia:</label>
              <input type="text" required name="coloniaCliente" value="{{ $datosCliente->shipping_address->line2 }}" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label>Codigo Postal:</label>
              <input type="text" required name="cpCliente" value="{{ $datosCliente->shipping_address->postal_code }}" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label>Ciudad:</label>
              <input type="text" required name="ciudadCliente" value="{{ $datosCliente->shipping_address->city }}" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label>Estado:</label>
              <input type="text" required name="estadoCliente" value="{{ $datosCliente->shipping_address->state }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">F I N A L I Z A R</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--   Core JS Files   -->
<script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>


@endsection