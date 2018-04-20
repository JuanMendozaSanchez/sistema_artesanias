@extends('plantilla.dashboard')

@section('title', 'Categorías')

@section('contenido')
@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
      <strong>
        <a href="#">
        <span class="glyphicon glyphicon-remove rojo"></span>
        </a>{{ Session::get('mensaje') }}  
        </strong>
    </p>                
@endif
          <div class="content">
            <div class="container-fluid">
              <div class="row"><!--inicio row-->
                <div class="col-md-12">
                  <div class="col-container">
                    <div class="col vl-r bg-primary" >
                      <h2 class="text-center">Lista de Categorías</h2>
                      <hr>
                      <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($categorias as $categoria)
                          <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>

                          </tr>
                        @empty
                            <li>No hay categorías registradas.</li>
                        @endforelse
                        
                      </tbody>
                    </table>
                    </div>

                    <div class="col vl-l bg-success" >
                      <h2 class="text-success text-center">Agregar nueva categoría</h2>
                      <hr>
                      <form action="">
                        <div class="form-group">
                          <label for="nombre">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                          <label for="desc">Descripción:</label>
                          <input type="text" class="form-control" id="desc" name="desc">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="col-container">
                    <div class="col vl-r bg-warning" >
                      <h2 class="text-warning text-center">Modificar Categoría</h2>
                      <hr>
                      <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($categorias as $categoria)
                          <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td>
                              <a href="/.../{{ $categoria->id }}" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></a>
                            </td>
                          </tr>
                        @empty
                            <li>No hay categorías registradas.</li>
                        @endforelse
                      </tbody>
                    </table>
                    </div>

                    <div class="col vl-l bg-danger" >
                      <h2 class="text-danger text-center">Eliminar Categoría</h2>
                      <hr>
                      <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($categorias as $categoria)
                          <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td>
                              <form action="{{URL::to('/')}}/.../{{ $categoria->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar usuario?')"><span class="glyphicon glyphicon-trash"></span></button>
                              </form>
                            </td>
                          </tr>
                        @empty
                            <li>No hay categorías registradas.</li>
                        @endforelse
                      </tbody>
                    </table>
                    </div>
                  </div>
                  

                  

              </div><!--fin row-->
              <hr>
              <br>
            </div>    
          </div>
<br>
@endsection