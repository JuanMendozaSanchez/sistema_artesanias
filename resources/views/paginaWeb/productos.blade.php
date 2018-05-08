@extends('layouts.app')

@section('title','Catalogo de productos')

@section('content')
<style type="text/css">
          .cart_anchor{ 
              position:fixed;
              left: 90%;
              top: 18%;
              background: url('img/muestra/cart-icon.png') no-repeat center center / 100% auto;
              width: 60px;
              height: 60px; 
              z-index: 3;
              border: 2px solid red;
              background-color: #FDFA03;
              border-radius: 50%;
              opacity: 0.9;

          }
        .cart_anchor:hover{
          cursor: pointer;
          background-color: #00FA0C;
        }

        #addP{
          width: 4rem;
          height: 4rem;
        }

        .miBtn{
          font-size: 2rem;
          font-weight: bold;
          color: red;
        }

        .miBtn:hover,.miBtn:active{
          text-decoration: none;
        }

        #etiCant{
          margin-left: 80%;
          background-color: black;
        }
        
        table thead{
          background-color:#49FF6B;
        }
        table td:nth-child(4){
          width: 90px;
        }
        table td:nth-child(5){
          width:100px;
        }
        table td:last-child {
          width:60px;
        }
table td:first-child {
          width:1px;
        }

        div>.totalFinal{
          text-align: right;
          padding-right: 13%;
          font-size:2rem;
          font-weight:bold;
        }
        </style>
  <div class="container ">
    <div class="row fondo-prod">
      <!-- begin row-->
      <div class="col-md-12">
        
        <link rel="stylesheet" href=" {{ asset('css/page/webpage.css')}}">

        <!-- MAIN (Center website) -->
        <div class="main">
        <h1>PRODUCTOS</h1>
        <hr>
        
        
        <a class="cart_anchor" data-toggle="modal" data-target="#myModal"><span class="badge" id="etiCant"></span></a>

        <h2>CATEGORIAS</h2>
        <input type="hidden" id="subcat" value="{{ $subcategorias }}">
        <div id="myBtnContainer" class="col-sm-10">
          <button class="btn active btn-default dropdown-toggle " onclick="filterSelection('all')" id="btnMain"> Mostrar todo <span class="badge ">{{ $productos->count() }}</span></button>
          @forelse($categorias as $categoria)
            <button class="btn btn-default cate" value="{{ $categoria->id }}" onclick="filterSelection('{{ $categoria->nombre }}')" > {{ $categoria->nombre }} <span class="badge">{{$productos->where('categoria',$categoria->nombre)->count()}}</span></button>

          @empty
            <p>No hay categorias</p>
          @endforelse
        <hr>
        </div>
        <div class="col-sm-2 text-center">
          <button type="button" class="btn btn-warning top-marg" id="filtro"><span class="glyphicon glyphicon-chevron-down"></span> Filtrar</button> 
            
          <div class="collapse">
            <select class="form-control top-marg" name="subcategoria" id="subopt">
              <option value="sin subcategoria">Selecciona una categoria</option>
            </select>
            <hr>
          </div>
        


        <!-- END MAIN -->
        </div>
        

          

        </div>
      </div>

      <div class="row col-md-12">

        @forelse($productos as $producto)
          <div class="column {{ $producto->categoria }} {{ $producto->subcat }} col-lg-3 col-md-4 col-sm-6 portfolio-item ">
            <div class="content ">
            <div class="card text-center">

              <a data-toggle="tooltip" title="{{ $producto->nombre }}"><img class=" img-thumbnail alto-img zoom" src="{{asset('img/productos')}}/{{ $producto->ruta }}" alt="{{ $producto->nombre }}" style="width: 90%"></a>
              <div class="card-body">
                <h4 class="card-title text-left">
                  {{ $producto->nombre }}
                </h4>
                <input type="hidden" id="code" value="{{ $producto->codigo }}">
                <input type="hidden" id="prod" value="{{ $producto->nombre }}">
                <p class="card-text text-left">{{ $producto->categoria }}</p>
                <p class="card-text text-left" >Precio: $ {{ $producto->precio_venta }}</p>
                <input type="hidden" id="precio" value="{{ $producto->precio_venta }}">
                <p class="card-text text-left">{{ $producto->descripcion }}</p>
                <p class="card-text text-left">Piezas disponibles: {{ $producto->existencia }}</p>
              </div>
              <a href="javascript:void(0);" class="add-to-cart miBtn" >Agregar <img src="{{ asset('img/muestra/add.png') }}" id="addP"></a>
            </div>
          </div>
          </div>
        @empty
          <p>No hay productos</p>
        @endforelse
      </div>
      


      <!--end row-->
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Artículos agregados al carrito</h4>
        </div>
        <div class="modal-body tabla" >
          <table id="tabla" class="table table-sm">
            <thead >
              <tr>
                <td></td>
                <td>Imagen</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="totalFinal" >
            <label>Total: $</label>
            <span id="totalFinal">$ 00.00</span>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-6">
            <button class="btn btn-danger" id="vaciar">Vaciar <span class="glyphicon glyphicon-shopping-cart"></span></button>
            <button type="button" class="btn btn-info" data-dismiss="modal">Seguir Comprando</button>
          </div>
          <div class="col-md-6">
            
          <button class="btn btn-success" id="ok">Pagar</button>
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div><!-- Modal -->


      <script src="{{ asset('js/page/webpage.js') }}" defer></script>
<script type="text/javascript">
  if (sessionStorage.length == 0 || sessionStorage.getItem('cantidad')=='0' ) { 
    sessionStorage.setItem('cantidad',parseInt(0));
    sessionStorage.setItem('contaS',0);
    $('.cart_anchor').removeAttr( "data-target" );
  }else{
    document.getElementById('etiCant').innerHTML = sessionStorage.getItem('cantidad');
    document.getElementById('etiCant2').innerHTML = sessionStorage.getItem('cantidad');
    $(".cart_anchor").attr("data-target","#myModal");

    //cargar articulos de sessionstorage
    var artGuardados =JSON.parse(sessionStorage.getItem('articulos')) ;
    var totalGuardado=sessionStorage.getItem('total');

    //console.log('objetoObtenido: ', artGuardados['articulo'],"\n total: ",totalGuardado,"\n canti: ",sessionStorage.getItem('cantidad'),"\n longitud array: ",artGuardados['articulo'].length,"\n indexfila: ",sessionStorage.getItem('contaS'));

    var tds=$("#tabla tr:first td").length;
      var trs=$("#tabla tr").length;
    for (var i = 0; i < artGuardados['articulo'].length; i++) {
      if (artGuardados['articulo'][i]!=null) {
        var nuevaFila="<tr>";
         nuevaFila+="<td><input type='hidden' id='numFila'  value='"+artGuardados['articulo'][i].numFila+"'/></td>"+
         "<td><img src='"+artGuardados['articulo'][i].img+"' alt='Producto' class='avatar-p' title='"+artGuardados['articulo'][i].nombre+"'></td>"+
         "<td><input class='form-control' type='text' disabled name='producto'  value='"+artGuardados['articulo'][i].nombre+"'/> </td>"+
          "<td><input class='form-control' type='number'  name='cantidad' required min='0'  minlength='1' maxlength='40' value='"+artGuardados['articulo'][i].cantidad+"'/> </td>"+
          "<td><input class='form-control pf' type='number' min='0' disabled  name='precio' value='"+artGuardados['articulo'][i].precio+"'/> </td>"+
         "<td><button class='borrar btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></td>"
         ;
         nuevaFila+="</tr>";
         $("#tabla").append(nuevaFila);
      }
      
      
    }

    

    $("#totalFinal").html(totalGuardado);
    sessionStorage.setItem('contaS',parseInt(sessionStorage.getItem('contaS'))+1);
  }
  
  function flyToElement(flyer, flyingTo) {
    var $func = $(this);
    var divider = 6;
    var flyerClone = $(flyer).clone();
    $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
    $('body').append($(flyerClone));
    var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
    var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
     
    $(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: $(flyer).width()/divider,
        height: $(flyer).height()/divider
    }, 900,
    function () {
        $(flyingTo).fadeOut('fast', function () {
            $(flyingTo).fadeIn('fast', function () {
                $(flyerClone).fadeOut('fast', function () {
                    $(flyerClone).remove();
                });
            });
        });
    });
    

    sessionStorage.setItem('cantidad',parseInt(sessionStorage.getItem('cantidad'))+parseInt(1));
    document.getElementById('etiCant').innerHTML = sessionStorage.getItem('cantidad');
    document.getElementById('etiCant2').innerHTML = sessionStorage.getItem('cantidad');
    //can
     //ó sessionStorage[producto]=precio
    //console.log(cantidadProductos);
}

$(document).ready(function(){
    $('.add-to-cart').on('click',function(){
        //Scroll to top if cart icon is hidden on top
        $('html, body').animate({
            //'scrollTop' : $(".cart_anchor").position().top
        });
        //Select item image and pass to the function
        var itemImg = $(this).parent().find('#addP').eq(0);
        //var itemImg = $(this).parent().find('span').eq(0);
        flyToElement($(itemImg), $('.cart_anchor'));
        $(".cart_anchor").attr("data-target","#myModal");
    });

    $('#vaciar').on('click',function(){
      sessionStorage.clear();
      sessionStorage.setItem('cantidad',parseInt(0));
      sessionStorage.setItem('total',parseFloat(0));
      sessionStorage.setItem('contaS',parseInt(0));

      document.getElementById('etiCant').innerHTML = "";
      document.getElementById('etiCant2').innerHTML ="";

      $('.cart_anchor').removeAttr( "data-target" );
      $("#tabla tbody tr").each(function (){
        $(this).remove();
      });
      $("#totalFinal").html("00.00");
      total=0;
      $('#ok').attr('disabled',true)
      
    });
});


///funcion para agregar productos al carrito
  contador=1;
   contador_select=1;

   var total=0;
 $(".add-to-cart").click(function(){
   var tds=$("#tabla tr:first td").length;
   var trs=$("#tabla tr").length;
   var nuevaFila="<tr>";

         var img=$(this).parent().find('.zoom').eq(0).attr('src');
         //console.log(img);
         var codigo=$(this).parent().find('#code').val();
         var producto=$(this).parent().find('#prod').val();
         var cantidad=1;
         var precio=$(this).parent().find('#precio').val();
         //console.log(img," "+producto," "+cantidad," "+precio);

         //var contaSession=sessionStorage.getItem('cantidad');
         

         nuevaFila+="<td><input type='hidden' id='numFila'  value='"+sessionStorage.getItem('contaS')+"'/></td>"+
         "<td><img src='"+img+"' alt='Producto' class='avatar-p' title='"+producto+"'></td>"+
         "<td><input class='form-control' type='text' disabled name='producto'  value='"+producto+"'/> </td>"+
          "<td><input class='form-control' type='number'  name='cantidad' required min='0'  minlength='1' maxlength='40' value='"+cantidad+"'/> </td>"+
          "<td><input class='form-control pf' type='number' min='0' disabled  name='precio' value='"+precio+"'/> </td>"+
         "<td><button class='borrar btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></td>"
         ;
         nuevaFila+="</tr>";
         $("#tabla").append(nuevaFila);

         if (sessionStorage.getItem('total')==null) {
           total=parseFloat(total)+parseFloat(precio);
         }else{
          total=parseFloat(sessionStorage.getItem('total'))+parseFloat(precio);
         }
         


         //inputT.value=(subtotal+(subtotal*iva)).toFixed(2);
         $("#totalFinal").val(total);
         $("#totalFinal").html(total);
         
         
         var tempCant=sessionStorage.getItem('contaS')
         if (sessionStorage.getItem('articulos')==null) {
              tempArt={'articulo':[{'numFila':tempCant,'codigo':codigo,'img':img,'nombre': producto, 'cantidad': cantidad, 'precio': precio}]};
           //console.log("entro al articulos null");
         }else{
          var tempArt=JSON.parse( sessionStorage.getItem('articulos'));
              tempArt['articulo'].push({'numFila':tempCant,'codigo':codigo,'img':img,'nombre': producto, 'cantidad': cantidad, 'precio': precio});
         }

         sessionStorage.setItem('articulos',JSON.stringify(tempArt));
         sessionStorage.setItem('total',total);

         contador+=1;
         sessionStorage.setItem('contaS',parseInt(sessionStorage.getItem('contaS'))+1);
         //console.log(sessionStorage.getItem('contaS'));
 });

 $(document).on('click', '.borrar', function (event) {
     event.preventDefault();
     var pf=$(this).parents("tr").find('td:eq(4)>input').val();
     var fila=$(this).parents("tr").find('td:eq(0)>input').val();

     var lista =JSON.parse(sessionStorage.getItem('articulos')) ;
     //console.log(lista['articulo']);
     for (var i = 0; i < lista['articulo'].length; i++) {
      //console.log("entro al for ");
      if (lista['articulo'][i]==null) {
      }else{
        if ( lista['articulo'][i].numFila==fila) {
         delete lista['articulo'][i];
         sessionStorage.setItem('articulos',JSON.stringify(lista));
         //console.log(lista['articulo']);
         //console.log("entro a if para borrar: ", lista['articulo']);

         total=parseFloat(sessionStorage.getItem('total'))-parseFloat(pf);
         sessionStorage.setItem('total',total);
         //console.log('total::: ',sessionStorage.getItem('total'));


         var tempCant=document.getElementById('etiCant').innerHTML;
         sessionStorage.setItem('cantidad',parseInt(tempCant)-1);
         document.getElementById('etiCant').innerHTML = sessionStorage.getItem('cantidad');
         document.getElementById('etiCant2').innerHTML = sessionStorage.getItem('cantidad');
       }
      }
     }
     //console.log(pf);
     //total=parseFloat(sessionStorage.getItem('total'))-parseFloat(pf);
     $(this).closest('tr').remove();
     var trs=$("#tabla tr").length;
     //console.log(trs);

     if (trs<=1) {
      sessionStorage.clear();
      sessionStorage.setItem('cantidad',parseInt(0));
      document.getElementById('etiCant').innerHTML = "";
      document.getElementById('etiCant2').innerHTML ="";
      $('.cart_anchor').removeAttr( "data-target" );
      total=0;

      $("#totalFinal").html("00.00");
      $('#ok').attr('disabled',true)
     }else{
        $("#totalFinal").html(total);
     }
     
 });
</script>
  
@endsection
