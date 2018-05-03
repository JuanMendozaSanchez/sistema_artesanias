@extends('ventas.principal')

@section('title', 'Cancelar Productos Vendidos')

@section('contenido')
    
<div class="row">
    <div class="col-md-10 col-md-offset-1">
          @if(Session::has('mensaje'))
        <p class="alert alert-success">
            <strong>
                <a href="/listadoCancelarP">
                    <span class="glyphicon glyphicon-remove rojo"></span>
                </a>
                {{ Session::get('mensaje') }}</i>
            </strong>
        </p>                
    @endif
        
    <h1 class="text-center">Productos vendidos {{ $detalles->count() }}</h1>
    <a href="ventas"><button class="btn btn-danger btn-lg "><span class="glyphicon glyphicon-chevron-left"></span> Salir</button></a>

    <form class="navbar-form navbar-left pull-right fondo_b"  method="GET" action="/buscarFolioV" role="search">
        <div class="form-group">
            <input type="text" required minlength="1" name="folio" class="form-control" placeholder="Ingresa el folio de venta">
        </div>
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
    <a href="listadoCancelarP"><button class="btn btn-info btn-lg"><i class="ti-view-list"></i>Listado</button></a>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th>Folio de venta</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
            <th>Opción</th>
        </tr>
        @forelse ($detalles as $producto)
            <tr>
                <td>{{$producto->folio}}</td>
                <td>{{$producto->nombre_producto}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>{{$producto->precio_unitario}}</td>
                <td>{{$producto->total}}</td>
                <td class="text-center">
                    <form action="{{URL::to('/')}}/cancelarProducto/{{ $producto->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de cancelar el producto?')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @empty
            <li>No hay detalles de ventas registradas.</li>
        @endforelse
    </table>
    </div>
    

    </div>
</div>

  <script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>
@endsection