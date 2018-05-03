@extends('ventas.principal')

@section('title', 'Cancelar Venta')

@section('contenido')
    
<div class="row">
    <div class="col-md-10 col-md-offset-1">
          @if(Session::has('mensaje'))
        <p class="alert alert-success">
            <strong>
                <a href="/listadoCancelarVenta">
                    <span class="glyphicon glyphicon-remove rojo"></span>
                </a>
                {{ Session::get('mensaje') }}</i>
            </strong>
        </p>                
    @endif
        
    <h1 class="text-center">Ventas realizadas {{ $ventas->count() }}</h1>
    <a href="ventas"><button class="btn btn-primary btn-lg "><span class="glyphicon glyphicon-chevron-left"></span> Salir</button></a>
    
    <hr>
    <div class="table-responsive">
        
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Efectivo</th>
            <th>Cambio</th>
            <th>Opción</th>
        </tr>
        @forelse ($ventas as $venta)
            <tr>
                <td>{{$venta->folio}}</td>
                <td>{{$venta->fecha}}</td>
                <td>{{$venta->nombre_usuario}}</td>
                <td>{{$venta->subtotal}}</td>
                <td>{{$venta->total}}</td>
                <td>{{$venta->efectivo}}</td>
                <td>{{$venta->cambio}}</td>
                <td class="text-center">
                    <form action="{{URL::to('/')}}/cancelarVenta/{{ $venta->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de cancelar la venta?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @empty
            <li>No hay ventas registrados.</li>
        @endforelse
    </table>

    </div>
</div>

  <script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection