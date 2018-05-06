
@extends('plantilla.dashboard')

@section('title', 'Reportes')

@section('contenido')

        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Reportes</h4>
                        <p class="category">Aquí se encuentra el listado de reportes que el Sistema puede generar. Con las opciones de visualizar o descargar</p>

                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Listado</h5>
                                <div class="alert alert-info alert-with-icon row" data-notify="container">
                                    <span data-notify="icon" class="glyphicon glyphicon-scissors"></span>
                                    <div class="col-md-9">
                                    <span data-notify="message" class="text-center">
                                        <b>Realizar corte por día y de acuerdo al usuario "logueado"</b>
                                    </span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-group btn-group-justified">
                                            <a href="verReporteVentas/{{Auth::user()->id}}/1" class="btn btn-default" target="_blank" title="Ver"><span class="ti-eye" style="font-size: 2rem;"></span></a>

                                            <a href="verReporteVentas/{{Auth::user()->id}}/2" class="btn btn-default" title="Descargar"><span class="glyphicon glyphicon-download" style="font-size: 2rem;"></span></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info alert-with-icon row" data-notify="container">
                                    <span data-notify="icon" class="ti-money"></span>
                                    <div class="col-md-9">
                                    <span data-notify="message" class="text-center">
                                        <b>Generar reportes de ventas</b>
                                    </span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-group btn-group-justified">
                                            <a href="vistaVentas" class="btn btn-default" title="Ir" target="blank"><span class="glyphicon glyphicon-new-window" style="font-size: 2rem;"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br><!--
                        <div class="places-buttons">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Notifications Places
                                        <p class="category">Click to view notifications</p>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('top','left')">Top Left</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('top','center')">Top Center</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('top','right')">Top Right</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom','left')">Bottom Left</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom','center')">Bottom Center</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default btn-block" onclick="demo.showNotification('bottom','right')">Bottom Right</button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

@endsection