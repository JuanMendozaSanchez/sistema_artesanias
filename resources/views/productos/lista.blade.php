@extends('plantilla.dashboard')

@section('title', 'Usuarios listado')

@section('contenido')
<div class="panel-body">
    
    <form class="navbar-form navbar-left pull-right fondo_b"  method="GET" action="/buscarProducto" role="search">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre producto" required="">
        </div>
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
    @if($busqueda=='1')
        <h3>Lista de productos en almacen</h3>
        <table class="table table-striped">
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Existencia</th>
            <th>Categoria</th>
        </tr>
        @forelse ($productos as $producto)
            <tr>
                <td>{{$producto->codigo}}</td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->descripcion}}</td>
                <td>{{$producto->precio_compra}}</td>
                <td>{{$producto->precio_venta}}</td>
                <td>{{$producto->existencia}}</td>
                <td>{{$producto->categoria}}</td>
            </tr>
        @empty
            <li>No hay usuarios productos registrados.</li>
        @endforelse
    </table>
    <a class="btn btn-warning" href="/listaProductos">Regresar</a>
    <hr>
    <br>
    @else
        <h2>Lista de productos en almacen {{ $productos->total() }}</h2>

            <table class="table table-striped">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio de compra</th>
                    <th>Precio de venta</th>
                    <th>Existencia</th>
                    <th>Categoria</th>
                </tr>
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{$producto->codigo}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->precio_compra}}</td>
                        <td>{{$producto->precio_venta}}</td>
                        <td>{{$producto->existencia}}</td>
                        <td>{{$producto->categoria}}</td>
                    </tr>
                @empty
                    <li>No hay productos registrados.</li>
                @endforelse
            </table>
            {!! $productos->render() !!}
            <hr>
            <br>
    @endif
</div>
    
@endsection