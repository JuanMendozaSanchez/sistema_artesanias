@extends('plantilla.dashboard')

@section('title', 'La Oaxaqueña')

@section('contenido')

          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <!--___________________________-->
                  
                    <input type="hidden" id="varphp" value="{{ $varphp=$categorias }}">
                    <script type="text/javascript" src="{{ asset('js/tablas/edit_table.js') }}"></script>
                    
                    <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12" >
                        
                        <center>
                          <h4>Lista de productos para agregar</h4>
                          <br>
                          <button id="agregar" class=" btn btn-info">Agregar</button></center>
                        <hr>
                        <form action="entradaProducto" method="post">
                        <table class="table table-bordered " style="width: 100%" id="tabla">
                        <thead>
                        <tr class="info">
                        <td><b>Codigo</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Descripción</b></td>
                        <td><b>Precio compra</b></td>
                        <td><b>Precio venta</b></td>
                        <td><b>Cantidad</b></td>
                        <td><b>Categoria</b></td>
                        <td><b>Opción</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="fila-0 celda">
                        <input type="hidden" id="contador-filas" value="1" />
                        <td ><input class="form-control " type="text" name="codigo" placeholder="codigo" required /></td>
                        <td><input class="form-control" type="text" name="nombre" placeholder="nombre" required /></td>
                        <td><input class="form-control" type="text" name="descripcion" placeholder="descripción" required /></td>
                        <td><input class="form-control" type="text" name="precio_c" placeholder="precio compra" required /></td>
                        <td><input class="form-control" type="text" name="precio_v" placeholder="precio venta" required /></td>
                        <td><input class="form-control" type="text" name="existencia" placeholder="existencia" required /></td>
                        <td><select class="form-control" name="categoria[]">
                              @foreach ($categorias as $categoria) 
                                <option>{{ $categoria->nombre }}</option>
                              @endforeach
                            </select>
                        </td>
                        <td><button class="borrar btn btn-danger"><i class="ti-close"></i></button></td>
                        </tr>
                        </tbody>
                        </table>
                        <button type="submit" id="save" name="datos" class="btn  btn-success">Guardar </button>
                        <button type="reset" name="borrar" class="btn  btn-warning" >Limpiar </button>
                        </form>
                      </div>
                      
                    

                    </div>
                    </div>

                  <!--___________________________-->
                  
                </div>
              </div>
            </div>
          </div>
          <hr>


@endsection