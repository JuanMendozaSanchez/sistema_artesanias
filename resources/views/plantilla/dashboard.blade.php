<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
    @include('partials._evitarCache')
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title') - Sistema</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--  CSS estilos propios     -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" />



    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('recursos/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('recursos/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('recursos/css/paper-dashboard.css')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('recursos/css/demo.css')}}" rel="stylesheet" />


    <link href="{{ asset('recursos/css/themify-icons.css')}}" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="wrapper">
    @include('partials._sidebar')
    
    <div class="main-panel">
        @include('partials._nav')


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!--@include('partials._cards')-->
                    @yield('contenido')
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users Behavior</h4>
                                <p class="category">24 Hours performance</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Click
                                        <i class="fa fa-circle text-warning"></i> Click Second Time
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--@include('partials._cards2')-->
            </div>
        </div>


        @include('partials._footer')

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{asset('recursos/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
	<script src="{{asset('recursos/js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{asset('recursos/js/bootstrap-checkbox-radio.js')}}"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('recursos/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('recursos/js/bootstrap-notify.js')}}"></script>

    

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="{{asset('recursos/js/paper-dashboard.js')}}"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{asset('recursos/js/demo.js')}}"></script>

	<script type="text/javascript">
     $(document).ready(function(){

            /*/demo.initChartist();

            $.notify({
                icon: 'ti-gift',
                message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 50
            });*/

    });   

    </script>

</html>
