
                    $(document).ready(function(){
                      contador=1;
                      contador_select=1;
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
                     var arr=jQuery.parseJSON( datos );

                     
                      //console.log(arr[0].nombre);

                      //$('#contador-filas').val(cantidad);
                      nuevaFila+="<td><input class='form-control' type='text' id='codigo["+contador+"]' name='codigo' placeholder='codigo requerido único' required minlength='4' maxlength='40' onkeyup='myFunction()'/> </td>"+

                      "<td><input class='form-control' type='text' disabled id='nombre["+contador+"]' name='nombre' placeholder='nombre' required minlength='3' maxlength='180'/></td>"+
                      "<td><input class='form-control' type='number' name='existencia' placeholder='cantidad' required min='0'  minlength='1' maxlength='30'/> </td>"+
                    
                      /*"<td><select class='form-control' id='ns["+contador_select+"]' name='categoria'></select></td>"+*/
                      "<td><button class='borrar btn btn-danger'><i class='ti-close'></i></button></td>"
                      
                      ;
                      
                      // Añadimos una columna con el numero total de columnas.
                      // Añadimos uno al total, ya que cuando cargamos los valores para la
                      // columna, todavia no esta añadida
                      nuevaFila+="</tr>";
                      $("#tabla").append(nuevaFila);

                      /*var select = document.getElementById("ns["+contador_select+"]");
                      //miSelect.appendChild(miOption);
                      for (var i = 0; i < arr.length; i++) {
                          var opt = document.createElement('option');
                          opt.value = arr[i].nombre;
                          opt.innerHTML = arr[i].nombre;
                          select.appendChild(opt);
                        
                      }*/
                      contador+=1;
                      //console.log(contador);

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

                    //funcion obtener datos
                    


                    
                    });

