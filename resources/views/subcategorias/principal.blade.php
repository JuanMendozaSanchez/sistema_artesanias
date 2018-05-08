@extends('plantilla.dashboard')

@section('title', 'Subcategorías')

@section('contenido')
@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
      <strong>
        <a href="subcategorias">
        <span class="glyphicon glyphicon-remove rojo"></span>
        </a>{{ Session::get('mensaje') }}  
        </strong>
    </p>                
@endif
          <div class="content">
            <div class="container-fluid">
              <div class="row"><!--inicio row-->
                <h1 class="text-center">Subcategorías</h1>
                <div class="col-md-12">
                  <div class="col-container">
                    <div class="col vl-r bg-primary tabla" >
                      <h2 class="text-center">Lista de Subcategorías</h2>
                      <hr>
                      <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th>Id categoría</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($subcategorias as $subcategoria)
                          <tr>
                            <td>{{ $subcategoria->sub_id }}</td>
                            <td>{{ $subcategoria->nombre }}</td>
                            <td>{{ $subcategoria->descripcion }}</td>

                          </tr>
                        @empty
                            <li>No hay categorías registradas.</li>
                        @endforelse
                        
                      </tbody>
                    </table>
                    </div>

                    <div class="col vl-l bg-success" >
                      <h2 class="text-success text-center">Agregar nueva Subcategoría</h2>
                      <hr>
                      <form action="agregarSubcategoria" method="POST">
                        @csrf
                        <div class="form-group">
                          <label  class="control-label " for="exampleInputPassword1">Categoría*:</label>
                          <div  >
                            <select class="form-control" name="categoria" id="myOptions">
                                @foreach ($categorias as $categoria) 
                                  <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="nombre">Nombre*:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" minlength="3" maxlength="150" required placeholder="Nombre de la Subcategoría, minimo 3 caracteres">
                        </div>
                        <div class="form-group">
                          <label for="desc">Descripción:</label>
                          <input type="text" class="form-control" id="desc" name="desc" placeholder="Agregar descripción (opcional)" maxlength="200">
                        </div>
                        <div class="text-center">
                          <br>
                          <br>
                          <button type="submit" class="btn btn-success" style="width: 50%">Agregar</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="col-container">
                    <div class="col vl-l bg-danger" >
                      <h2 class="text-danger text-center">Eliminar Subcategoría</h2>
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
                        @forelse ($subcategorias as $subcategoria)
                          <tr>
                            <td>{{ $subcategoria->sub_id }}</td>
                            <td>{{ $subcategoria->nombre }}</td>
                            <td>{{ $subcategoria->descripcion }}</td>
                            <td>
                              <form action="{{URL::to('/')}}/eliminarporNombre/{{ $subcategoria->nombre }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar la Subcategoría?')"><span class="glyphicon glyphicon-trash"></span></button>
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