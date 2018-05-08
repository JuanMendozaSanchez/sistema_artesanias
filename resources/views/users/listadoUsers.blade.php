@extends('plantilla.dashboard')

@section('title', 'Usuarios listado')

@section('contenido')
<div class="panel-body tabla">
    
    <form class="navbar-form navbar-left pull-right fondo_b"  method="GET" action="/buscar_user" role="search">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
    @if($busqueda=='1')
        <h3>Lista de usuarios</h3>
        <table class="table table-striped">
        <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono fijo</th>
            <th>Teléfono celular</th>
            <th>Dirección</th>
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
                <td>{{$user->tel_fijo}}</td>
                <td>{{$user->tel_cel}}</td>
                <td>{{$user->direccion}}</td>
                <td>{{$tipoUser}}</td>
            </tr>
        @empty
            <li>No hay usuarios registrados.</li>
        @endforelse
    </table>
    <hr>
    <br>
    @else
        <h2>Usuarios registrados {{ $usuarios->total() }}</h2>

            <table class="table table-striped">
                <tr>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono fijo</th>
                    <th>Teléfono celular</th>
                    <th>Dirección</th>
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
                        <td>{{$user->tel_fijo}}</td>
                        <td>{{$user->tel_cel}}</td>
                        <td>{{$user->direccion}}</td>
                        <td>{{$tipoUser}}</td>
                    </tr>
                @empty
                    <li>No hay usuarios registrados.</li>
                @endforelse
            </table>
            {!! $usuarios->render() !!}
            <hr>
            <br>
    @endif
</div>
    
@endsection