
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Codigo de barras de {{ $producto->nombre }} </title>
  <style>
 
 .col-md-12 {
    width: 100%;
} 

.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table, table td {
    background-color: transparent;
    border: 1px solid #2C2121;
}
table td {
    padding: 1rem;
}
b{
    background-color: yellow;
}

strong{
    color: blue;
}

.card{
    text-align: center;
    align-content: center;
    padding-left: 0.5rem;
}

/* .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #2C2121;
}*/



</style>
</head>
<body>
  <div >
         <h4>Codigo de barras para el producto: <strong>{{$producto->nombre }}</strong> -- Generado por el usuario: <b>{{ $usuario }} el día {{ date('d-m-Y') }}</b></h4>

         
         <table class="table table-bordered">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @for($i=0;$i<8;$i++)
            <tr>
                <td>
                    <div class="card">
                        <span>{{ $producto->nombre }} </span>
                        <span> ${{ $producto->precio_venta }}</span>
                        <br>
                        <span>{!!$barra::getBarcodeHTML($codigo, "C39") !!}</span>
                        <span>{{ $codigo }}</span>
                     </div>
                </td>
                <td>
                    <div class="card">
                        <span>{{ $producto->nombre }} </span>
                        <span> ${{ $producto->precio_venta }}</span>
                        <br>
                        <span>{!!$barra::getBarcodeHTML($codigo, "C39") !!}</span>
                        <span>{{ $codigo }}</span>
                     </div>
                </td>
                <td>
                    <div class="card">
                        <span>{{ $producto->nombre }} </span>
                        <span> ${{ $producto->precio_venta }}</span>
                        <br>
                        <span>{!!$barra::getBarcodeHTML($codigo, "C39") !!}</span>
                        <span>{{ $codigo }}</span>
                    </div>
                </td>
            </tr>
         @endfor
        
    </table>
         
    </div>
</body>
</html>