
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

$('.btn').on('click', function(){
    $(this).siblings().removeClass('active'); // if you want to remove class from all sibling buttons
    $(this).toggleClass('active');
});


/////______________________________________________________--
//inicio de funciones para realizar filtros de subcategorias    
    $('.cate').click(function() {

    //var val = $("#myOptions option:selected").val();
    var val = $(this).val();
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

    
});

          $('#subopt').change(function() {

    var val = $("#subopt option:selected").text();
    filterSelection(val);


    
    
});

          $("#filtro").click(function(){
                  $(".collapse").collapse('toggle');
                  $(".collapse").collapse();
                  $(this).find('span:first').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
              });

          $("#btnMain").click(function(){
                  var select2 = document.getElementById("subopt");
                  var i;
                  for(i = select2.options.length - 1 ; i >= 0 ; i--)
                  {
                      select2.remove(i);
                  }
                  var opt = document.createElement('option');
          opt.innerHTML = "Selecciona una categoria";
          select2.appendChild(opt);
              });
/////______________________________________________________--
//fin de funciones para realizar filtros de subcategorias 

