
                    $(document).ready(function(){
                      conta=0;
                    $("#agregar").click(function(){
                      // Obtenemos el numero de columnas (td) que tiene la primera fila
                      // (tr) del id "tabla"
                      var tds=$("#tabla tr:first td").length;
                      // Obtenemos el total de filas (tr) del id "tabla"
                      var trs=$("#tabla tr").length;
                      var nuevaFila="<tr class='celda'>";
                      //cantidad = $('#contador-filas').val();
                      //cantidad++;

                      $("#save").removeAttr("disabled");

                      //arreglo de categorias
                     var datos = document.getElementById('varphp').value;
                     var arr=jQuery.parseJSON( datos );;
                      //console.log(arr[0].nombre);

                      //$('#contador-filas').val(cantidad);
                      nuevaFila+="<td><input class='form-control' type='text' name='codigo' placeholder='codigo' required /> </td>"+

                      "<td><input class='form-control' type='text' name='nombre' placeholder='nombre' required /> </td>"+

                      "<td><input class='form-control' type='text' name='descripcion' placeholder='descripción' required /> </td>"+
                      "<td><input class='form-control' type='text' name='precio_c' placeholder='precio compra' required /> </td>"+
                      "<td><input class='form-control' type='text' name='precio_v' placeholder='precio venta' required /> </td>"+
                      "<td><input class='form-control' type='text' name='cantidad' placeholder='cantidad' required /> </td>"+
                    
                      "<td><select class='form-control' id='ns["+conta+"]' name='categoria'></select></td>"+
                      "<td><button class='borrar btn btn-danger'><i class='ti-close'></i></button></td>"
                      

                      
                      ;
                      
                      // Añadimos una columna con el numero total de columnas.
                      // Añadimos uno al total, ya que cuando cargamos los valores para la
                      // columna, todavia no esta añadida
                      nuevaFila+="</tr>";
                      $("#tabla").append(nuevaFila);

                      //select = document.getElementByName('categoria');
                      //var select=document.getElementsByName('categoria');
                      //var select=document.getElementsByTagName('categoria');
                      select = document.getElementById("ns["+conta+"]");
                      //miSelect.appendChild(miOption);
                      for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i].nombre;
                        opt.innerHTML = arr[i].nombre;
                        select.appendChild(opt);
                      }
                      conta+=1;
                     

                    });

                    $(document).on('click', '.borrar', function (event) {
                        event.preventDefault();
                        $(this).closest('tr').remove();
                        var trs=$("#tabla tr").length;
                        
                        if (trs<=1) {
                          $("#save").attr("disabled",true);
                          //$('#contador-filas').val('0');
                          //console.log($('#contador-filas').val());
                        }else{
                        
                        }
                        
                        
                    });
                    
                    });