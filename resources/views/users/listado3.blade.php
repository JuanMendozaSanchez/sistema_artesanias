@extends('plantilla.dashboard')

@section('title', 'Eliminar usuario')

@section('contenido')
    
    @if(Session::has('mensaje'))
        <p class="alert alert-success"><a href="/datos_usuarios2"><i class="fa fa-close"></i></a>
            {{ Session::get('mensaje') }}  <i class="fa fa-check"></i>
        </p>                
    @endif

    <h1>Usuarios existentes {{ $usuarios->total() }}</h1>

    
    
    <table class="table table-striped table-bordered">
        <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
        @forelse ($usuarios as $user)
            @if($user->tipo==='1')
                <p hidden="hidden">{{$tipoUser='Administrador'}}</p>
            @else
                <p hidden="hidden">{{$tipoUser='Normal'}}</p>
            @endif
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$tipoUser}}</td>
                <td>
                    <form action="{{URL::to('/')}}/eliminar_usuario/{{ $user->id }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </table>
    {!! $usuarios->render() !!}
    <hr>
    <br>

@endsection