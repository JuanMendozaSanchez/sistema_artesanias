@extends('plantilla.dashboard')

@section('title', 'Agregar usuario')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success"><a href="/formulario_usuario">
    	<strong>
    		<i class="fa fa-close"></i>
    		</a>{{ Session::get('mensaje') }}  <i class="fa fa-check"></i>
        </strong>
    </p>                
@endif

<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
		<h1>Agregar nuevo usuario</h1>
	</div>
</div>

<br>

<div class="row " >
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form method="post"  action="/agregar_nuevo_usuario" name="user">
		  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
		  <div class="form-group">
		    <label class="control-label" for="exampleInputEmail1">Nombre</label>
		    <input type="text" class="form-control" name="inputNombre" placeholder="Nombre completo al menos 3 caracteres"  required   minlength="3" maxlength="180">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Correo</label>
		    <input type="email" class="form-control" name="inputCorreo" placeholder="Correo electrónico, no debe repetirse"  required  minlength="6" maxlength="180">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Contraseña</label>
		    <input type="password" class="form-control" name="inputPass" placeholder="contraseña al menos seis caracteres"  required  minlength="6" maxlength="180">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Tipo</label>
		    <select class="form-control" name="tipo">
			  <option value="1">1 Administrador</option>
			  <option value="2">2 Normal</option>
			</select>
		  </div>
		  <button type="submit" class="btn btn-success">Aceptar</button>
		  <button type="reset" class="btn btn-warning" value="Borrar información">Limpiar</button> 
		</form>
	</div>
</div>


<br>
<hr>
<div class="row">
	<div class="col-md-12">
		<h2>Usuarios existentes {{ $usuarios->total() }}</h2>
		<br>
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
	    {!! $usuarios->render() !!}
    <hr>
    <br>
	</div>
</div>

@endsection