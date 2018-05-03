@extends('plantilla.dashboard')

@section('title', 'Reporte de Ventas')

@section('contenido')
<div>
    <button class="btn btn-default" id="mostrarSide" ><span class="ti-angle-double-right"></span></button>  
</div>
  
 <div class="col-md-10 col-md-offset-1">
          @if(Session::has('mensaje'))
            <p class="alert alert-success">
                <strong>
                    <a href="/listadoCancelarVenta">
                        <span class="glyphicon glyphicon-remove rojo"></span>
                    </a>
                    {{ Session::get('mensaje') }}</i>
                </strong>
            </p>                
          @endif
        
    
    
    <div class="">
        <div class="col-md-12 fondo-ventas">
            <div class="col-md-6">
                <div class="card card2 ">
                  <div class="card-body">
                    <h4 class="card-title">Reporte General</h4>
                    <p class="card-text">Genera el reporte de todas las ventas.</p>
                    <div class="btn-group btn-group-justified">
                        <a href="reporteVentasGral/1" target="_blank" class="card-link btn btn-default">Ver</a>
                        <a href="reporteVentasGral/2" class="card-link btn btn-default">Descargar</a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card2 ">
                  <div class="card-body">
                    <h4 class="card-title">Reporte Anual</h4>
                    <p class="card-text">Genera el reporte las ventas realizadas en el año.</p>
                    <div class="btn-group btn-group-justified">
                        <a href="reporteVentasAnual/1" target="_blank" class="card-link btn btn-default">Ver</a>
                        <a href="reporteVentasAnual/2" class="card-link btn btn-default">Descargar</a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card2 ">
                  <div class="card-body">
                    <input type="hidden" id="mes" value="">
                    <h4 class="card-title">Reporte mensual</h4>
                    <p class="card-text text-justify">Esta opción genera el reporte de ventas del mes en actual.</p>
                    <div class="btn-group btn-group-justified">
                        <a href="" id="verMes" target="_blank" class="card-link btn btn-default">Ver</a>
                        <a href="" id="downMes" class="card-link btn btn-default">Descargar</a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card2 ">
                  <div class="card-body">
                    <h4 class="card-title">Reporte de Hoy</h4>
                    <p class="card-text text-justify">Aquí se genera el reporte general de ventas del día.</p>
                    <div class="btn-group btn-group-justified">
                        <a href="reporteVentasHoy/1" target="_blank" class="card-link btn btn-default">Ver</a>
                        <a href="reporteVentasHoy/2" class="card-link btn btn-default">Descargar</a>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="card card2 ">
                  <div class="card-body">
                    <h4 class="card-title text-center">Reporte con fechas personalizadas</h4>
                    <p class="card-text">
                        <form class="form-inline" target="_blank" action="reporteVentasBetween/1" method="GET">
                            <div class=" text-center">
                                <div class="input-group date col-md-4">
                                    <label>Fecha inicial</label>
                                    <input type="date" required="" class="form-control" id="fechaI" name="fechaI" value="{{ date('Y-m-d') }}" >
                                </div>
                                <div class="input-group date col-md-4">
                                    <label>Fecha final</label>
                                    <input type="date" required="" class="form-control" id="fechaF" name="fechaF" value="{{ date('Y-m-d') }}" >
                                </div>
                                <div class="btn-group btn-group-justified ">
                                    <a ><button type="submit" class="card-link btn btn-default btn-lg" >Generar</button></a>
                                </div>
                            </div>
                        </form>
                    </p>
                    <div class="btn-group btn-group-justified">
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row col-md-12" style="" >
    <h1 class="text-center">Lista total de ventas realizadas</h1>
    <hr>
    <div class="table-responsive"  >
        <p id="separa"></p>
        <table class="table table-striped table-bordered">
        <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Efectivo</th>
            <th>Cambio</th>
        </tr>
        @forelse ($ventas as $venta)
            <tr>
                <td>{{$venta->folio}}</td>
                <td>{{$venta->fecha}}</td>
                <td>{{$venta->nombre_usuario}}</td>
                <td>{{$venta->subtotal}}</td>
                <td>{{$venta->total}}</td>
                <td>{{$venta->efectivo}}</td>
                <td>{{$venta->cambio}}</td>
            </tr>
        @empty
            <li>No hay ventas registradas.</li>
        @endforelse
    </table>
    {!! $ventas->render() !!}
    </div>
    

    </div>
</div>

  
    <script type="text/javascript">
        $(document).ready(function(){
            var bandera=false;
            $(".sidebar").toggle();
            $('.main-panel').css('position', 'fixed');
            $(".main-panel").width('100%');
            $("#mostrarSide").click(function(){
                if(bandera==false){
                    //$('#mostrarSide').prop('title', 'Mostrar');
                    $('.main-panel').css('position','');
                    $(".main-panel").width('');
                    $(".sidebar").toggle();
                    bandera=true;
                }else{
                    $(".sidebar").toggle();
                    $('.main-panel').css('position', 'fixed');
                    $(".main-panel").width('100%');
                    bandera=false;
                }
                $("span", this).toggleClass("ti-angle-double-right ti-angle-double-left");
            });


            //var now = new Date();

            //var day = ("0" + now.getDate()).slice(-2);
            //var month = ("0" + (now.getMonth() + 1)).slice(-2);

            //var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            //$('#fechaI').val(today);
            var date=document.getElementById('fechaI').value;
            //console.log(date);

            //split string and store it into array
            array = date.split('-');
            //$('#mes').val(array[1]);
            $('#verMes').prop("href", "reporteVentasMensual/1/"+array[1]);
            $('#downMes').prop("href", "reporteVentasMensual/2/"+array[1]);
            //from array concatenate into new date string format: "DD.MM.YYYY"
            //var newDate = (array[2] + "-" + array[1] + "-" + array[0]);
            //console.log(array[1]);

        });
    </script>
@endsection