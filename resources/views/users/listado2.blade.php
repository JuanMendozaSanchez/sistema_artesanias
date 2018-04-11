@extends('plantilla.dashboard')

@section('title', 'Modificar usuario')

@section('contenido')
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
                <td><a href="/nueva_ruta/{{ $user->id }}" class="btn btn-warning">Modificar</a>
                    
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