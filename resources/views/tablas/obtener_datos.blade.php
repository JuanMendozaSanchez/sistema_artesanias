@extends('plantilla.dashboard')

@section('title', 'La Oaxaqueña')

@section('contenido')

          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <!--___________________________-->
                  <!--Te dejo un tabla para que puedas ejecutar el script, solo modifica a tus necesidades.-->

<div class="btn_save">
  <form action="datos_a" method="POST" onsubmit="grabaTodoTabla('tablita')">

<table  id="tablita">
  <thead></thead>
  <tbody>
    <tr>
  <td><input type="text" id="a" name="a" value="" required="" /></td>
  <td><input type="text" id="b" name="b" value="" required="" /></td>
  </tr>
  <tr>
  <td><input type="text" id="a" name="a"  /></td>
  <td><input type="text" id="b" name="b"  /></td>
  </tr>
  <tr>
  <td><input type="text" id="a" name="a" value="" /></td>
  <td><input type="text" id="b" name="b" value="" /></td></td>
  </tr><!--
  <tr>
  <td><input type="text" id="a" name="a" value="otro" /></td>
  <td><input type="text" id="b" name="b" value="mendoza" /></td>
  </tr>
  <tr>
  <td><input type="text" id="a" name="a"  /></td>
  <td><input type="text" id="b" name="b"  /></td>
  </tr>-->
  </tbody>

</table>

    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="datos" id="datos">
    <input type="hidden" name="codigos" id="codigos">
    <button type="submit" class="btns"  title="Grabar">
    GRABAR DATOS
  </button>
  </form>

  <!--<button type="submit" class="btns" onclick="grabaTodoTabla('tablita')" title="Grabar">
    GRABAR misma pag
  </button>-->
  
</div>

<script type="text/javascript">
// Actualiza de manera masiva todos los archivos cargados en la tercera pestaña.
function grabaTodoTabla(TABLAID){
  //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
  var DATA  = [];
  var CODE=[];
  var TABLA   = $("#"+TABLAID+" tbody > tr");

  //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
  TABLA.each(function(){
    //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
    var ID    = $(this).find("input[name*='a']").val(),
      DESC  = $(this).find("input[name*='b']").val(),
      //CLAS  = $(this).find("select").val();

    //entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
    item = {};
    cod={};
    //si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
    if(ID !== ''){
          cod ["nombre"]   = ID;
          item ["apellido"]   = DESC;
          //item ['tipo']   = CLAS;
          //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
          DATA.push(item);
          CODE.push(cod);
    }
  });
  
  
  //return DATA;
  //JSON.stringify(DATA);
  var myJsonString = JSON.stringify(DATA);
  var myJsonString2 = JSON.stringify(CODE);

  document.getElementById("datos").value=myJsonString;
  document.getElementById("codigos").value=myJsonString2;
  //console.log(myJsonString);
  /*/eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.
  INFO  = new FormData();
  aInfo   = JSON.stringify(DATA);

  INFO.append('data', aInfo);

  $.ajax({
    data: INFO,
    type: 'POST',
    url : './funciones_upload.php',
    processData: false, 
    contentType: false,
    success: function(r){
      //Una vez que se haya ejecutado de forma exitosa hacer el código para que muestre esto mismo.
    }
  });*/
}
</script>

                  <!--___________________________-->
                  
                </div>
              </div>
            </div>
          </div>
          <hr>
@endsection