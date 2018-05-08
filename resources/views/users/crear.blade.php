@extends('plantilla.dashboard')

@section('title', 'Agregar usuario')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
    	<strong>
    		<a href="/formulario_usuario"><span class="glyphicon glyphicon-remove rojo"></span>
    		</a>{{ Session::get('mensaje') }}  
        </strong>
    </p>                
@endif

<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8 text-center">
		<h1>Agregar nuevo usuario</h1>
	</div>
</div>

<br>

<div class="row " >
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form method="post"  action="/agregar_nuevo_usuario" name="user" accept-charset="UTF-8" enctype="multipart/form-data">
		  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
		  <div class="form-group" id="div-foto" >
		  	<div >
		  		<img src="{{ asset('img/usuarios/user.png') }}" id="output" >
		  	</div>
		  		<br>
              <label class="btn btn-default" id="etiqueta" >Foto de perfil
              	<h6 id="fotico"></h6>
				<div >
                	<input type="file" class="form-control" name="file" accept="image/*"  onchange="loadFile(event)" title="Agregar foto de perfil" id="file">
              	</div>
              </label>
              <hr>
          </div>
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
		    <label class="control-label" for="exampleInputEmail1">Teléfono fijo</label>
		    <input type="text" class="form-control" name="tel_fijo" placeholder="Número de telefono de casa, si no tiene solo poner 0"  required   minlength="1" maxlength="50">
		  </div>
		  <div class="form-group">
		    <label class="control-label" for="exampleInputEmail1">Teléfono celular</label>
		    <input type="text" class="form-control" name="tel_cel" placeholder="Número de telefono celular, obligatorio!!!"  required   minlength="10" maxlength="50">
		  </div>

		  <div class="form-group">
		    <label class="control-label" for="exampleInputEmail1">Dirección</label>
		    <input type="text" class="form-control" name="direccion" placeholder="Dirección obligatoria, minimo 10 caracteres"  required   minlength="10" maxlength="200">
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
	<div class="col-md-12 tabla">
		<h2>Usuarios existentes {{ $usuarios->total() }}</h2>
		<br>
		<table class="table table-striped table-bordered">
	        <tr>
	            <th>Clave</th>
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
	</div>
</div>
<script>
  var loadFile = function(event) {
  	var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    var nom=document.getElementById('file').files[0].name;
    var texto=document.getElementById('fotico').innerHTML=nom;
  };
</script>

@endsection