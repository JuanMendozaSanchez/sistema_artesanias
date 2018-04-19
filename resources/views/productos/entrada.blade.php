@extends('plantilla.dashboard')

@section('title', 'Entradas')

@section('contenido')
@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
      <strong>
        <a href="/entradaProducto">
        <span class="glyphicon glyphicon-remove rojo"></span>
        </a>{{ Session::get('mensaje') }}  
        </strong>
    </p>                
@endif
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <!--___________________________-->

                    <input type="hidden" id="varphp2" value="{{ $varphp2=$productos2 }}">
                    <input type="hidden" id="varphp" value="{{ $varphp=$categorias }}">
                    <script type="text/javascript" src="{{ asset('js/tablas/edit_table.js') }}"></script>
                    
                    <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12" >
                        
                        <center>
                          <h4>Lista de productos para agregar</h4>
                          <br>
                          <button id="agregar" disabled class=" btn btn-info">Agregar</button></center>
                        <hr>
                        <form action="ejecutarEntrada" method="POST" onsubmit="grabaTodoTabla('tabla')">
                        <table class="table table-bordered " style="width: 100%" id="tabla">
                        <thead>
                        <tr class="info">
                        <td><b>Codigo</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Cantidad</b></td>
                        <!--<td><b>Categoria</b></td>-->
                        <td><b>Opción</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="fila-0 celda">
                        <input type="hidden" id="contador-filas" value="1" />

                        <td ><input class="form-control " type="text" id="codigo[0]" name="codigo" placeholder="codigo requerido único" required   minlength="4" maxlength="40" onkeyup="myFunction()"  /></td>

                        <td><input disabled class="form-control" type="text" id="nombre[0]" name="nombre" placeholder="nombre producto" required minlength="3" maxlength="180" /></td>

                        <td><input class="form-control" type="number" name="existencia" placeholder="cantidad" required min="0"  minlength="1" maxlength="30"/></td>

                        <!--<td><select class="form-control" id="ns[0]" name="categoria">
                              @foreach ($categorias as $categoria) 
                                <option>{{ $categoria->nombre }}</option>
                              @endforeach
                            </select>
                        </td>-->
                        <td><button disabled class="borrar btn btn-danger"><i class="ti-close"></i></button></td>
                        </tr>
                        </tbody>
                        </table>
                        
                        <!--Input ocultos para datos y token-->
                        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="datos2" id="datos2">
                        <input type="hidden" name="codigos" id="codigos">

                        <button type="submit" id="save" name="datos" class="btn  btn-success">Guardar </button>
                        <button type="reset" name="borrar" class="btn  btn-warning" >Limpiar </button>
                        </form>
                        <br>
                        <hr>
                      </div>
                      <h2>Lista de productos en almacen {{ $productos->total() }}</h2>

            <table class="table table-striped">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio de compra</th>
                    <th>Precio de venta</th>
                    <th>Existencia</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
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
                        <td><img src="{{ asset('img/productos/'.$producto->ruta)}}" alt="Avatar" class="avatar-p" title="{{ $producto->nombre }}"></td>
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

                  <!--___________________________-->
                  
                </div>
              </div>
            </div>
          </div>
          <hr>

<script type="text/javascript">
function grabaTodoTabla(TABLAID){
  var DATA  = [];
  var CODE=[];
  var TABLA   = $("#"+TABLAID+" tbody > tr");

  //arreglo de productos
  var datosProd = document.getElementById('varphp2').value;
  var arrProd=jQuery.parseJSON( datosProd );

  TABLA.each(function(){
    var COD    = $(this).find("input[name*='codigo']").val(),
      NOM  = $(this).find("input[name*='nombre']").val(),
      EX  = $(this).find("input[name*='existencia']").val(),
      CAT  = $(this).find("select[name*='categoria']").val();

      for (var i = 0; i < arrProd.length; i++) {
        if (arrProd[i].codigo==COD) {
          EX=parseInt(EX)+parseInt(arrProd[i].existencia);
        }
      }
      

    item = {};
    cod={};

    if(COD !== ''){
          cod ["codigo"]   = COD;
          item ["nombre"]   = NOM;
          item ["existencia"]   = EX;
          item ["categoria"]   = CAT;

          DATA.push(item);
          CODE.push(cod);
    }
  });
  
  
  var myJsonString = JSON.stringify(DATA);
  var myJsonString2 = JSON.stringify(CODE);

  document.getElementById("datos2").value=myJsonString;
  document.getElementById("codigos").value=myJsonString2;
}

function myFunction() {
    if (contador==1) {
      var codi = document.getElementById("codigo[0]").value;
      if (codi.length>=4) {
        console.log("entro al if con contador = "+contador);
        
        var x = document.getElementById("nombre[0]");

        //arreglo de productos
        var datos = document.getElementById('varphp2').value;
        var jsonProductos=jQuery.parseJSON( datos );

        for (var i = 0; i < jsonProductos.length; i++) {
            if (jsonProductos[i].codigo==codi) {
              x.value=jsonProductos[i].nombre;
            }
          }
          contador+=1;
          var btnAdd = document.getElementById("agregar");
          btnAdd.disabled = false;
      }

    }else{
      contador_nuevo=contador-1;
      if (contador_nuevo==1) {
        
      }else{
        console.log('contador nuevo = '+contador_nuevo);
        var codi = document.getElementById("codigo["+contador_nuevo+"]").value;


        if (codi.length>=4) {
          console.log("entro al if con contador = "+contador_nuevo);
          
          var x = document.getElementById("nombre["+contador_nuevo+"]");

          //arreglo de productos
          var datos = document.getElementById('varphp2').value;
          var jsonProductos=jQuery.parseJSON( datos );

          for (var i = 0; i < jsonProductos.length; i++) {
              if (jsonProductos[i].codigo==codi) {
                x.value=jsonProductos[i].nombre;
              }
            }
        }
      }
      

    }

    
    
}
</script>
@endsection