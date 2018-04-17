@extends('plantilla.dashboard')

@section('title', 'Modificar Producto')

@section('contenido')
    <h1>Productos existentes {{ $productos->total() }}</h1>

    

    <table class="table table-striped table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Existencia</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Acción</th>
        </tr>
        @forelse ($productos as $producto)
            <tr>
                <td><img src="{{ asset('img/productos/'.$producto->ruta)}}" alt="Avatar" class="avatar-p" title="{{ $producto->nombre }}"></td>
                <td>{{$producto->codigo}}</td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->descripcion}}</td>
                <td>{{$producto->precio_compra}}</td>
                <td>{{$producto->precio_venta}}</td>
                <td>{{$producto->existencia}}</td>
                <td>{{$producto->categoria}}</td>
                <td>{{$producto->subcat}}</td>
                <td><a href="/modificarProducto/{{ $producto->id }}" class="btn btn-warning">Modificar</a> 
                </td>
            </tr>
        @empty
            <li>No hay productos registrados.</li>
        @endforelse
    </table>
    {!! $productos->render() !!}
    <hr>
    <br>

@endsection