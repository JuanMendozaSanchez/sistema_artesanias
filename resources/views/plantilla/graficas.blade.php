
@extends('plantilla.dashboard')

@section('title', 'Gráficas')

@section('contenido')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Gráficas de Ventas</h4>
                                <p class="category">En esta sección se muestran las gráficas de ventas por mes</p>
                            </div>
                            <div class="content">
                                <div id="pop_div"></div>
                                <!-- With Blade Templates-->
                                @areachart('Ventas', 'pop_div')

                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Gráficas de los productos más vendidos</h4>
                                <p class="category">Productos más vendidos</p>
                            </div>
                            <div class="content">

                                <div id="pop_divP"></div>
                                <!-- With Blade Templates-->
                                @columnchart('Productos', 'pop_divP')

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endsection