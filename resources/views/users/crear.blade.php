@extends('layout')

@section('title', 'Usuarios :D')

@section('formulario_usuarios')
<h1>Agregar nuevo usuario</h1>
<br>

@if($bandera===1)
	<script type="text/javascript">$(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });</script>
@endif

<div class="modal fade bs-example-modal-sm" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
         	<h3>Aviso</h3>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	     </div>
         <div class="modal-body">
            <p>Usuario agregado correctamente!</p>   
     	 </div>
         <div class="modal-footer">
	        <a href="#" data-dismiss="modal" class="btn btn-info">Cerrar</a>
	     </div>
      </div>
   </div>
</div>

<div class="row">
	<div class="col-md-8">
		<form method="post"  action="agregar_nuevo_usuario">
		  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
		  <div class="form-group">
		    <label for="exampleInputEmail1">Nombre</label>
		    <input type="text" class="form-control" name="inputNombre" placeholder="Nombre completo">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Correo</label>
		    <input type="email" class="form-control" name="inputCorreo" placeholder="Correo electrónico">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Contraseña</label>
		    <input type="password" class="form-control" name="inputPass" placeholder="contraseña">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Tipo</label>
		    <select class="form-control" name="tipo">
			  <option value="1">1 Administrador</option>
			  <option value="2">2 Normal</option>
			</select>
		  </div>
		 
		  <button type="submit" class="btn btn-success">Aceptar</button>
		</form>
	</div>
</div>


<br>
<hr>
<div class="row">
	<div class="col-md-12">
		<h2>Usuarios existentes</h2>
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
	</div>
</div>

@endsection