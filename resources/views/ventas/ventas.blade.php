@extends('ventas.principal')

@section('title', 'Ventas')

@section('contenido')

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
                      
                      <button  id="add" class=" btn btn-info">Cargar Producto</button>
                    </center>
                </div>
                <div class="col-md-8 bg-info">
                  <!--___________________________ inicio col 12-->
                    <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12 table-responsive" >
                        <h2 class="text-center text-primary">Lista de productos</h2>
                        <form id="formita" method="POST" action="realizarVenta" onsubmit="grabaTodoTabla('tabla')">
                          @csrf
                            <input type="hidden" id="varFolio" name="folioo" value="{{ $ventas }}">
                        <table class="table table-sm " style="width: 100%" id="tabla">
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
                            <input value="0" disabled type="text" name="subtotal" id="subtotal" style="width: 50%;float: right;" >
                            <input type="hidden" name="subtotal2" id="subtotal2">
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Total:</label>
                            <input value="0" disabled type="text"  name="total" id="total" style="width: 50%;float: right;" >
                            <input type="hidden" name="total2" id="total2">
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Efectivo:</label>
                            <input value="0" type="number" step="any" minlength="1" name="efectivo" id="efectivo" required style="width: 50%;float: right;" onkeyup="myFunction()"  min="0">
                          </div>
                          <div class="input-group" style="width: 100%">
                            <label>Cambio:</label>
                            <input value="0" disabled type="text"  name="cambio" id="cambio"  style="width: 50%;float: right;">
                            <input type="hidden" name="cambio2" id="cambio2">
                          </div>
                        </div>
                        <div class="col-md-1"></div>

                        <center>
                          <div class="col-md-8">
                            <hr>
                            <button type="submit" id="save" name="datos" class="btn  btn-success btn-abajo" style="width: 50%;" disabled="">Realizar Venta </button>
                          </div>
                          <div class="col-md-4">
                            <hr>
                            <a href="ventas" name="borrar" class="btn  btn-danger btn-abajo" >Nueva Venta </a>
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

   var iva=0.16;
   var subtotal=0;
   var total=0;
 $("#add").click(function(){
   var tds=$("#tabla tr:first td").length;
   var trs=$("#tabla tr").length;
   var nuevaFila="<tr class='celda'>";

   //arreglo de productos
  var datos = document.getElementById('varphp').value;
  var productos=jQuery.parseJSON( datos );

  var codBar = document.getElementById("code").value;
  var cantidad = document.getElementById('canti').value;

  var inputSubT=document.getElementById('subtotal');
  var inputT=document.getElementById('total');

  if (codBar.length>=4) {

    for (var i = 0; i < productos.length; i++) {
       if (codBar==productos[i].codigo) {
         var c=productos[i].codigo;
         var n=productos[i].nombre;
         nuevaFila+="<td><input class='form-control' type='text' disabled id='codigo["+contador+"]' name='codigo' placeholder='codigo requerido único' required minlength='4' maxlength='40' value='"+c+"'/> </td>"+
         "<td><input class='form-control' type='text' disabled id='nombre["+contador+"]' name='nombre' placeholder='nombre' required minlength='3' maxlength='180' value='"+n+"'/></td>"+
         "<td><input class='form-control' type='number' disabled name='existencia' placeholder='cantidad' required min='0'  minlength='1' maxlength='30' value='"+cantidad+"'/> </td>"+
          "<td><input class='form-control' type='number' disabled step='any'  name='precioU' placeholder='Precio' required min='0'  minlength='1' maxlength='40' value='"+productos[i].precio_venta+"'/> </td>"+
          "<td><input class='form-control pf' type='number' disabled step='any'  name='precioF' placeholder='Precio Final' required min='0'  minlength='1' maxlength='40' value='"+cantidad*productos[i].precio_venta+"'/> </td>"+
         /*"<td><select class='form-control' id='ns["+contador_select+"]' name='categoria'></select></td>"+*/
         "<td><button class='borrar btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>"
         ;
         nuevaFila+="</tr>";
         $("#tabla").append(nuevaFila);

         subtotal=subtotal+(cantidad*productos[i].precio_venta);
         //inputSubT.value=subtotal.toFixed(2);
         //inputSubT.innerHTML=subtotal.toFixed(2);
         $("#subtotal").val(subtotal.toFixed(2));
         $("#subtotal2").val(subtotal.toFixed(2));


         //inputT.value=(subtotal+(subtotal*iva)).toFixed(2);
         $("#total").val((subtotal+(subtotal*iva)).toFixed(2));
         $("#total2").val((subtotal+(subtotal*iva)).toFixed(2));


         $("#save").attr("disabled",true);
         $("#efectivo").val('');
         $("#cambio").val('');

         var elem_p = document.getElementById('alerta');
         elem_p.className="";
        elem_p.innerHTML = '';

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

     //var c=$(this).('.pf').val();
     //var valores=0;
     var pf=$(this).parents("tr").find('td:eq(4)>input').val();
     console.log(pf);
     subtotal=subtotal-parseFloat(pf);
     $("#subtotal").val(subtotal.toFixed(2));
     $("#subtotal2").val(subtotal.toFixed(2));

     //inputT.value=(subtotal+(subtotal*iva)).toFixed(2);
     $("#total").val((subtotal+(subtotal*iva)).toFixed(2));
     $("#total2").val((subtotal+(subtotal*iva)).toFixed(2));

     var cash = document.getElementById("efectivo").value;
     var tot=document.getElementById('total').value;

      //console.log('total='+tot);
      //console.log('efec='+cash);
      if (parseFloat(cash) >= parseFloat(tot)) {
        var cam = document.getElementById("cambio");
        cam.value=(cash-tot).toFixed(2);
        $("#cambio2").val((cash-tot).toFixed(2));
        $("#save").removeAttr("disabled");
        //btnAdd.disabled = false;
      }else{
        $("#cambio").val(0);
        $("#efectivo").val(0);
        $("#save").attr("disabled",true);
      }

     $(this).closest('tr').remove();
     var trs=$("#tabla tr").length;
     //console.log(trs);

     if (trs<=1) {
      //console.log('entro al tr menor que 1');
       $("#save").attr("disabled",true);
       $("#cambio").val(0);
      $("#efectivo").val(0);
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

function myFunction() {
      var cash = document.getElementById("efectivo").value;
      var tot=document.getElementById('total').value;

      //console.log('total='+tot);
      //console.log('efec='+cash);
      if (parseFloat(cash) >= parseFloat(tot)) {
        var cam = document.getElementById("cambio");
        cam.value=(cash-tot).toFixed(2);
        $("#cambio2").val((cash-tot).toFixed(2));
        $("#save").removeAttr("disabled");
        //btnAdd.disabled = false;
      }else{
        $("#cambio").val(0);
        $("#save").attr("disabled",true);
      }

}
</script>

@endsection