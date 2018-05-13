
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

    $('#paypal-button').show();
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
    $('#paypal-button').show();
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

      $('#paypal-button').hide();
      
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
      $('#ok').attr('disabled',true);
      $('#paypal-button').hide();
     }else{
        $("#totalFinal").html(total);
     }
     
 });
