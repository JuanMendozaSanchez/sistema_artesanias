<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reporte de ventas</title>
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
b{
    background-color: yellow;
}

strong{
    color: blue;
}

/* .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #2C2121;
}*/



</style>
</head>
<body>
  <div >
         <h4>Reporte de ventas correspondiente  <strong>{{$titulo }}</strong> -- Generado por el usuario: <b>{{ $usuario }} el día {{ $date }}</b></h4>
        <input type="hidden" value="{{ $totalVendido=0 }}">
        <table class="table table-bordered">
        <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Efectivo</th>
            <th>Cambio</th>
            <th>Subtotal</th>
            <th>Total</th>
        </tr>
        @forelse ($data as $venta)
            <tr>
                <td>{{$venta->folio}}</td>
                <td>{{$venta->fecha}}</td>
                <td>{{$venta->nombre_usuario}}</td>
                <td>{{$venta->efectivo}}</td>
                <td>{{$venta->cambio}}</td>
                <td>{{$venta->subtotal}}</td>
                <td style="background-color: #54F654;color: black;font-weight: bold; text-align: right;">{{$venta->total}}</td>
            </tr>
            {{ $totalVendido=$totalVendido+$venta->total }}
        @empty
            <li>No hay ventas registradas.</li>
        @endforelse
    </table>
    <p style="text-align:  right;padding-right: 2px; font-size: 1.5rem; background-color: orange;color: ">Total vendido = {{ $totalVendido }}</p>
    </div>
</body>
</html>