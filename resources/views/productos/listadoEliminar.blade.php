@extends('plantilla.dashboard')

@section('title', 'Eliminar usuario')

@section('contenido')
    
    @if(Session::has('mensaje'))
        <p class="alert alert-success">
            <strong>
                <a href="/listadoEliminar">
                    <span class="glyphicon glyphicon-remove rojo"></span>
                </a>
                {{ Session::get('mensaje') }}</i>
            </strong>
        </p>                
    @endif

    <h1>Usuarios existentes {{ $productos->total() }}</h1>

    
    
    <table class="table table-striped table-bordered">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Existencia</th>
            <th>Categoría</th>
            <th>Subcategoría</th>
            <th>Acción</th>
        </tr>
        @forelse ($productos as $producto)
            <tr>
                <td>{{$producto->codigo}}</td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->descripcion}}</td>
                <td>{{$producto->existencia}}</td>
                <td>{{$producto->categoria}}</td>
                <td>{{$producto->subcat}}</td>
                <td>
                    <form action="{{URL::to('/')}}/eliminarProducto/{{ $producto->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar usuario?')">Eliminar</button>
                    </form>
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