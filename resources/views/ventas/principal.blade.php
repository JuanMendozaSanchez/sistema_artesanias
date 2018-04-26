<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  CSS estilos propios     -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('recursos/css/bootstrap.min.css')}}" rel="stylesheet" />

    <title>Modulo de Ventas</title>

  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand">VENTAS</a>
  </div>
 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      
    </ul>
 
    <ul class="nav navbar-nav navbar-right ">
            @guest
                <li><a class="nav-link" href="/logueo"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
            @else
                <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                
                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="btn btn-danger dropdown-item separador" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>
                    <p class="dropdown-item "></p>
                    <a class="btn btn-success dropdown-item" href="/home">Sistema</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                </div>
            </li>
            <li>
              <div class="div-avatar">
                <img src="{{ asset('img/usuarios/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar" title="{{ Auth::user()->name }}">
              </div>
            </li>
        @endguest
      </ul>
  </div>
</nav>
@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
      <strong>
        <a href="/ventas">
        <span class="glyphicon glyphicon-remove rojo"></span>
        </a>{{ Session::get('mensaje') }}  
        </strong>
    </p>                
@endif
          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <input type="hidden" id="varphp" value="{{ $productos }}">
                
                
                <div class="col-md-4 div1">
                  <h2 class="text-center text-primary">Ingresar producto</h2>
                  <p class="txt_cent " id="alerta">
                    
                  </p>
                    <center>
                      <div class="col-md-8">
                        <input type="text" required="" name="code" id="code" minlength="4" class="form-control" placeholder="Código" autofocus="">
                      </div>
                      
                      <div class="col-md-4">
                        <input type="number" name="canti" id="canti" value="1" required min='1'  minlength='1' maxlength='30'>
                      </div>
                      
                      <button  id="add" class=" btn btn-info">Agregar</button>
                    </center>
                </div>
                <div class="col-md-8 bg-info">
                  <!--___________________________ inicio col 12-->
                    <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12" >
                        <h2 class="text-center text-primary">Lista de productos</h2>
                        <form method="POST" action="realizarVenta" onsubmit="grabaTodoTabla('tabla')">
                          @csrf
                            <input type="hidden" id="varFolio" name="folioo" value="{{ $ventas }}">
                          <!--<input type="hidden" value="{{round(microtime(true) * 1000)}}" id="micro" name="micro">-->
                        <table class="table table-bordered " style="width: 100%" id="tabla">
                        <thead>
                        <tr class="info">
                        <td><b>Codigo</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Cantidad</b></td>
                        <td><b>Precio Unitario</b></td>
                        <td><b>Precio Final</b></td>
                        <td><b>Opción</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                        
                        <!--Input ocultos para datos y token-->
                        
                        <input type="hidden" name="datosVenta" id="datosVenta">
                        <input type="hidden" name="codigos" id="codigos">
                        <div class="col-md-7"></div>
                        <div class="col-md-4">
                          <div class="input-group " style="width: 100%">
                            <label>Subtotal:</label>
                            <input disabled type="number" step="any" minlength="1" name="subtotal" id="subtotal" style="width: 50%;float: right;">
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Total:</label>
                            <input disabled type="number" step="any" minlength="1" name="total" id="total" style="width: 50%;float: right;" >
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Efectivo:</label>
                            <input type="number" step="any" minlength="1" name="efectivo" id="efectivo" style="width: 50%;float: right;">
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Cambio:</label>
                            <input disabled type="number" step="any" minlength="1" name="cambio" id="cambio" style="width: 50%;float: right;">
                          </div>
                        </div>
                        <div class="col-md-1"></div>

                        <center>
                          <div class="col-md-8">
                            <hr>
                            <button type="submit" id="save" name="datos" class="btn  btn-success" style="width: 50%;" disabled="">Realizar Venta </button>
                          </div>
                          <div class="col-md-4">
                            <hr>
                            <a href="ventas" name="borrar" class="btn  btn-danger" >Nueva Venta </a>
                          </div>
                          
                        </center>
                        </form>
                        <br>
                        <hr>
                      </div>
                      
                    </div>
                    </div>

                  <!--___________________________ fin 12 columnas-->
                </div>
              </div>
            </div>
          </div>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--   Core JS Files   -->
    <script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
   contador=1;
   contador_select=1;
 $("#add").click(function(){
   var tds=$("#tabla tr:first td").length;
   var trs=$("#tabla tr").length;
   var nuevaFila="<tr class='celda'>";

   //arreglo de productos
  var datos = document.getElementById('varphp').value;
  var productos=jQuery.parseJSON( datos );

  var codBar = document.getElementById("code").value;
  var cantidad = document.getElementById('canti').value;

  if (codBar.length>=4) {

    for (var i = 0; i < productos.length; i++) {
       if (codBar==productos[i].codigo) {
         var c=productos[i].codigo;
         var n=productos[i].nombre;
         nuevaFila+="<td><input class='form-control' type='text' disabled id='codigo["+contador+"]' name='codigo' placeholder='codigo requerido único' required minlength='4' maxlength='40' value='"+c+"'/> </td>"+
         "<td><input class='form-control' type='text' disabled id='nombre["+contador+"]' name='nombre' placeholder='nombre' required minlength='3' maxlength='180' value='"+n+"'/></td>"+
         "<td><input class='form-control' type='number' disabled name='existencia' placeholder='cantidad' required min='0'  minlength='1' maxlength='30' value='"+cantidad+"'/> </td>"+
          "<td><input class='form-control' type='number' disabled step='any'  name='precioU' placeholder='Precio' required min='0'  minlength='1' maxlength='40' value='"+productos[i].precio_venta+"'/> </td>"+
          "<td><input class='form-control' type='number' disabled step='any'  name='precioF' placeholder='Precio Final' required min='0'  minlength='1' maxlength='40' value='"+cantidad*productos[i].precio_venta+"'/> </td>"+
         /*"<td><select class='form-control' id='ns["+contador_select+"]' name='categoria'></select></td>"+*/
         "<td><button class='borrar btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>"
         ;
         nuevaFila+="</tr>";
         $("#tabla").append(nuevaFila);

         var elem_p = document.getElementById('alerta');
         elem_p.className="";
        elem_p.innerHTML = '';

        $("#save").removeAttr("disabled");

         break;
       }else{
        var elem_p = document.getElementById('alerta');
        elem_p.className="txt_cent alert alert-warning";
        elem_p.innerHTML = 'El producto no existe';
       }
    }
  }else{
    var elem_p = document.getElementById('alerta');
        elem_p.className="txt_cent alert alert-warning";
        elem_p.innerHTML = 'Código incorrecto!!!';
  }

  
         contador+=1;
         document.getElementById("code").value="";
         document.getElementById("code").focus();

 });




 $(document).on('click', '.borrar', function (event) {
     event.preventDefault();
     $(this).closest('tr').remove();
     var trs=$("#tabla tr").length;
     
     if (trs<=1) {
       $("#save").attr("disabled",true);
     }else{
     
     }
     document.getElementById("code").focus();
     
 });



function grabaTodoTabla(TABLAID){
  var DATA  = [];
  var CODE=[];
  var restantes=0;
  var TABLA   = $("#"+TABLAID+" tbody > tr");

  //arreglo de productos
  var datosProd = document.getElementById('varphp').value;
  var arrProd=jQuery.parseJSON( datosProd );

  var folito=document.getElementById('varFolio').value;

  TABLA.each(function(){
    var COD    = $(this).find("input[name*='codigo']").val(),
      NOM  = $(this).find("input[name*='nombre']").val(),
      CANT  = $(this).find("input[name*='existencia']").val(),
      PU  = $(this).find("input[name*='precioU']").val();
      PF  = $(this).find("input[name*='precioF']").val();

      for (var i = 0; i < arrProd.length; i++) {
        if (arrProd[i].codigo==COD) {
          restantes=parseInt(arrProd[i].existencia)-parseInt(CANT);
        }
      }
      

    item = {};
    cod={};

    if(COD !== ''){
          cod ["codigo"]   = COD;
          cod ["existencia"]   = restantes;
          
          item ["folio"]   = folito;
          item ["codigo_producto"]   = COD;
          item ["nombre_producto"]   = NOM;
          item ["cantidad"]   = CANT;
          item ["precio_unitario"]   = PU;
          item ["total"]   = PF;

          DATA.push(item);
          CODE.push(cod);
    }
  });
  
  
  var myJsonString = JSON.stringify(DATA);
  var myJsonString2 = JSON.stringify(CODE);

  console.log(myJsonString);

  document.getElementById("datosVenta").value=myJsonString;
  document.getElementById("codigos").value=myJsonString2;
}
//console.log('finalizo el script');
</script>
    
  </body>
</html>

