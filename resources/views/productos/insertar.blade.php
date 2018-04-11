@extends('plantilla.dashboard')

@section('title', 'Agregar producto')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success"><a href="/formProducto">
    	<strong>
    		<span class="glyphicon glyphicon-remove rojo"></span>
    		</a>{{ Session::get('mensaje') }}  <i class="fa fa-check"></i>
        </strong>
    </p>                
@endif

<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">
		<center>
			<h3>Agregar nuevo producto</h3>
		</center>
		
	</div>
</div>
<hr>

<div class="row " >
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form method="POST"  action="/agregarProducto" name="producto" class="form-horizontal text-left">
		  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
		  <div class="form-group ">
		    <label class="control-label col-sm-3 " for="exampleInputEmail1">Código</label>
		    <div class="col-sm-9">
		    	<input type="text" class="form-control " name="codigo" placeholder="codigo único"  required   minlength="3" maxlength="40">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-3" for="exampleInputPassword1">Nombre</label>
		    <div class="col-sm-9">
		    <input type="text" class="form-control" name="nombre" placeholder="Nombre producto"  required  minlength="3" maxlength="180">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-3"  for="exampleInputPassword1">Descripción</label>
		    <div class="col-sm-9">
		    <input type="text" class="form-control" name="descripcion" placeholder="descripcion del producto (color, talla, etc)"  required  minlength="4" maxlength="180">
		    </div>
		  </div>

			<div class="form-group">
		    <label class="control-label col-sm-3"  for="exampleInputPassword1">Precio de compra</label>
		    <div class="col-sm-9">
		    <input type="number" class="form-control" name="pCompra" placeholder="precio de compra" min="0" step="any" required  minlength="1" maxlength="30">
		    </div>
		  </div>
		  <div class="form-group">
		    <label  class="control-label col-sm-3" for="exampleInputPassword1">Precio de venta</label>
		    <div class="col-sm-9">
		    <input type="number" class="form-control" name="pVenta" placeholder="precio de venta"  required min="0" step="any" minlength="1" maxlength="30">
		    </div>
		  </div>
		  <div class="form-group">
		    <label  class="control-label col-sm-3" for="exampleInputPassword1">Cantidad</label>
		    <div class="col-sm-9">
		    <input type="number" class="form-control" name="cantidad" placeholder="ingresa cantidad de productos "  required min="0"  minlength="1" maxlength="30">
		    </div>
		  </div>

		  <div class="form-group">
		    <label  class="control-label col-sm-3" for="exampleInputPassword1">Categoria</label>
		    <div class="col-sm-9">
		    <select class="form-control" name="categoria">
		    	@foreach ($categorias as $categoria) 
		    		<option>{{ $categoria->nombre }}</option>
		    	@endforeach
			</select>
			</div>
		  </div>
		  <center>
		  	<button type="submit" class="btn btn-success">Aceptar</button>
		  	<button type="reset" class="btn btn-warning" value="Borrar información">Limpiar</button> 
		  </center>
		</form>
	</div>
</div>


<br>
<hr>
<div class="row">
	<div class="col-md-12">
		<h2>Productos existentes {{ $productos->total() }}</h2>
		<br>
		<table class="table table-striped table-bordered">
	        <tr>
	            <th>Código</th>
	            <th>Nombre</th>
	            <th>Descripción</th>
	            <th>Precio de compra</th>
	            <th>precio de venta</th>
	            <th>Existencia</th>
	            <th>Categoria</th>
	        </tr>
	        @forelse ($productos as $producto)
	            <tr>
	                <td>{{$producto->codigo}}</td>
	                <td>{{$producto->nombre}}</td>
	                <td>{{$producto->descripcion}}</td>
	                <td>{{$producto->precio_compra}}</td>
	                <td>{{$producto->precio_venta}}</td>
	                <td>{{$producto->existencia}}</td>
	                <td>{{$producto->categoria}}</td>
	            </tr>
	        @empty
	            <li>No hay productos registrados.</li>
	        @endforelse
	    </table>
	    {!! $productos->render() !!}
    <hr>
    <br>
	</div>
</div>

@endsection