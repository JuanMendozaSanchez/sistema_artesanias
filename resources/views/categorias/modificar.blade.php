@extends('plantilla.dashboard')

@section('title', 'Datos de la categoría')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
        <strong>
            {{ Session::get('mensaje') }}  
        </strong>
        <a href="/categorias" class="btn btn-danger" role="button">Aceptar</a>
    </p>                
@endif
<!--<div class="alert alert-warning alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Cuidado!</strong> Es muy importante que si cambias el nombre de la categoría, posteriormente reasignes las categorias en los productos afectados.
</div>-->
    

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <center>
          <h1>Datos Categoría</h1>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
                    <tr>
                        <td>{{$categoria->id}}</td>
                        <td>{{$categoria->nombre}}</td>
                        <td>{{$categoria->descripcion}}</td>
                    </tr>
            </table>
            <a href="/categorias" class="btn btn-warning" role="button">Regresar</a>
          </center>
            
        </div>
    </div>
    
    <br>
    <hr>

    <div>
        <form role="form" method="post" action="/actualizarCategoria/{{$categoria->id}}" >
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="form-group col-md-4">
                <label >Identificador</label>
                <input type="text" class="form-control" name="id" value="{{ $categoria->id }}" disabled>
              </div>
              <div class="form-group col-md-4">
                <label >Nombre*:</label>
                <input type="text" class="form-control" name="nombre" value="{{ $categoria->nombre }}" required   minlength="3" maxlength="50">
              </div>
              <div class="form-group col-md-4">
                <label >Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="{{ $categoria->descripcion }}" >
              </div>
              <center>
                <button type="submit" class="btn btn-success btn-block" style="width: 50%;"><i class="fa fa-upload"></i> Modificar</button>
              </center>
              
          </form>
    </div>
          
        
    <br>

@endsection