@extends('plantilla.dashboard')

@section('title', 'Usuarios :D')

@section('contenido')
    <h1>Usuario existente</h1>

    

    <table class="table table-striped table-bordered">
        <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
            @if($usuario->tipo==='1')
                <p hidden="hidden">{{$tipoUser='Administrador'}}</p>
            @else
                <p hidden="hidden">{{$tipoUser='Normal'}}</p>
            @endif
            <tr>
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td>{{$tipoUser}}</td>
                <td><a href="/cargar_usuario/{{ $usuario->id }}">Modificar</a></td>
            </tr>
    </table>

          <form role="form" method="post" action="/modificar_usuario/{{$usuario->id}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
              <div class="form-group">
                <label >Nombre</label>
                <input type="text" class="form-control" name="inputNombre" value="{{ $usuario->name }}" required   minlength="3" maxlength="180">
              </div>
              <div class="form-group">
                <label >Correo</label>
                <input type="email" class="form-control" name="inputCorreo" value="{{ $usuario->email }}"  required  minlength="6" maxlength="180">
              </div>
              <div class="form-group">
                <label >Tipo</label>
                    @if($usuario->tipo==='1')
                        <select class="form-control" name="tipo">
                            <option value="1" selected="selected">1 Administrador</option>
                            <option value="2">2 Normal</option>
                        </select>
                    @elseif($usuario->tipo==='2')
                        <select class="form-control" name="tipo">
                            <option value="1" >1 Administrador</option>
                            <option value="2" selected="selected">2 Normal</option>
                        </select>
                    @endif
              </div>
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Aceptar</button>
          </form>
        

  <a href="/datos_usuarios" class="btn btn-warning" role="button">Regresar</a>

@endsection