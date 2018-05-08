@extends('plantilla.dashboard')

@section('title', 'Datos del Producto')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
        <strong>
            {{ Session::get('mensaje') }}  
        </strong>
        <a href="/listaModificar" class="btn btn-info" role="button">Aceptar</a>
    </p>                
@endif

    <h1>Datos del Producto</h1>

    <div class="row">
        <div class="col-md-12 tabla">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Imagen</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio de compra</th>
                    <th>Precio de venta</th>
                    <th>Existencia</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                </tr>
                    <tr>
                        <td><img src="{{ asset('img/productos/'.$producto->ruta)}}" alt="Avatar" class="avatar-p" title="{{ $producto->nombre }}"></td>
                        <td>{{$producto->codigo}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->precio_compra}}</td>
                        <td>{{$producto->precio_venta}}</td>
                        <td>{{$producto->existencia}}</td>
                        <td>{{$producto->categoria}}</td>
                        <td>{{$producto->subcat}}</td>
                    </tr>
            </table>
            <a href="/listaModificar" class="btn btn-warning" role="button">Regresar</a>
        </div>
    </div>
    <br>
    <hr>
    <div>


        <form role="form" method="post" action="/actualizarProducto/{{$producto->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group" id="div-foto" >
                <div >
                    <img src="{{ asset('img/productos/'.$producto->ruta)}}" id="output-modpro" >
                </div>
                    <br>
                  <label class="btn btn-default" id="etiqueta-modpro" >Cambiar imagen
                    <h6 id="fotico"></h6>
                    <div >
                        <input type="file" class="form-control" name="file" accept="image/*"  onchange="loadFile(event)" title="Cambiar imagen" id="file" value="{{ $producto->ruta }}">
                    </div>
                  </label>
                  <hr>
              </div> 
              <div class="form-group col-md-4">
                <label >Nombre</label>
                <input type="text" class="form-control" name="inputNombre" value="{{ $producto->nombre }}" required   minlength="3" maxlength="180">
              </div>
              
              <div class="form-group col-md-4">
                <label >Precio de compra</label>
                <input class="form-control" name="inputPrecioC" value="{{ $producto->precio_compra }}" required type="number" step="any" minlength="1" maxlength="30">
              </div>
              <div class="form-group col-md-4">
                <label >Precio de venta</label>
                <input class="form-control" name="inputPrecioV" value="{{ $producto->precio_venta }}" required type="number" step="any"  minlength="1" maxlength="30">
              </div>
              <div class="form-group col-md-4">
                <label >Existencia</label>
                <input type="number" class="form-control" name="inputExistencia" value="{{ $producto->existencia }}" required   minlength="1" maxlength="50">
              </div>
              <div class="form-group col-md-4">
                <label >Categoria</label>
                    <select class="form-control" name="categoria" id="myOptions">
                      <option value="{{$idCategoria}}" style="background-color: yellow">{{ $producto->categoria }}</option>
                      @foreach ($categorias as $categoria) 
                        @if($categoria->id!=$idCategoria)
                          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endif
                      @endforeach
                    </select>
              </div>
              <div class="form-group col-md-4">
                <label >Subcategoria</label>
                    <select class="form-control" name="subcategoria" id="subopt">
                      <option value="{{ $producto->subcat }}">{{ $producto->subcat }}</option>
                      @foreach ($subcat as $subcategoria) 
                        @if($subcategoria->sub_id==$idCategoria && $subcategoria->nombre!=$producto->subcat )
                          <option value="{{ $subcategoria->nombre }}">{{ $subcategoria->nombre }}</option>
                        @endif
                      @endforeach
                    </select>
              </div>
              <div class="form-group">
                <label >Descripción</label>
                <input type="text" class="form-control" name="inputDescripcion" value="{{ $producto->descripcion }}"  required  minlength="10" maxlength="200">
              </div>
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Aceptar</button>
          </form>
          <input type="hidden" id="subcat" value="{{ $subcat }}">
    </div>
          
        
    <br>
  <script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output-modpro');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

$('#myOptions').change(function() {

    var val = $("#myOptions option:selected").val();
    //console.log(val);    //poner .text() para obtener el texto

    //arreglo de subcategorias
    var subcategorias = document.getElementById('subcat').value;
    var arrsub=jQuery.parseJSON( subcategorias );

    var select2 = document.getElementById("subopt");
    var i;
    for(i = select2.options.length - 1 ; i >= 0 ; i--)
    {
        select2.remove(i);
    }

    for (var i = 0; i < arrsub.length; i++) {
      if (val==arrsub[i].sub_id) {
        var opt = document.createElement('option');
          opt.value = arrsub[i].nombre;
          opt.innerHTML = arrsub[i].nombre;
          select2.appendChild(opt);
      }
        
    }

    if(select2.length==0){
      var opt = document.createElement('option');
      opt.value = "Sin subcategoria";
      opt.innerHTML = "Sin subcategoria";
      select2.appendChild(opt);
    }

    
});
</script>

@endsection