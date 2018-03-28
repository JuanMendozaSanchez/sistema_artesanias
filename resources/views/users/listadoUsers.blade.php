@extends('layout')

@section('title', 'Usuarios :D')

@section('tabla_usuarios')
    <h1>Usuarios registrados</h1>

    

    <table class="table table-striped table-bordered">
        <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
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
            </tr>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </table>

@endsection