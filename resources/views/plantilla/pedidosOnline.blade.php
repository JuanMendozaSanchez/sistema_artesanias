
@extends('plantilla.dashboard')

@section('title', 'Lista de pedidos online')

@section('contenido')

@if(Session::has('mensaje'))
        <p class="alert alert-success">
            <strong>
                <a href="pedidos">
                    <span class="glyphicon glyphicon-remove rojo"></span>
                </a>
                {{ Session::get('mensaje') }}</i>
            </strong>
        </p>                
    @endif

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Pedidos en linea</h4>
                                <p class="category">Aquí se listan todos los pedidos que se realizaron en la Página Web. En cada pestaña se pueden ver los pedidos con el estatus correspondiente.</p>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#home"><i class="ti-timer"></i> Pendientes</a></li>
                                        <li><a data-toggle="tab" href="#menu1"><i class="ti-truck"></i> En Proceso</a></li>
                                        <li><a data-toggle="tab" href="#menu2"><i class="ti-check"></i> Entregado</a></li>
                                      </ul>

                                      <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                                @forelse($pedidos as $pedido)
                                                    @if($pedido->estatus=="pendiente")
                                                    <div class="col-md-12">
                                                    <div class="alert alert-dark row" data-notify="container" style="color: black;">
                                                       <h5>Pedido número: {{ $pedido->id }}</h5>
                                                       <div >
                                                        <hr>
                                                           <form class="form-inline text-center" action="enviaRastreo" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $pedido->id }}">
                                                            <input type="hidden" name="correo" value="{{ $pedido->correo }}">
                                                               <div class="form-group" >
                                                                  <label class="control-label" for="rastreo" style="color: black;">No. Rastreo:</label>
                                                                    <input type="text" class="form-control" id="rastreo" placeholder="Introduce Número de rastreo" name="rastreo" required minlength="10" maxlength="10">
                                                                </div>
                                                                    <button type="submit" class="btn btn-info">Enviar <i class="ti-truck"></i></button>
                                                           </form>
                                                           <hr>
                                                       </div>
                                                       <div class="col-md-4" >
                                                        <h6>Datos del Cliente: </h6>
                                                        <ul style="list-style-type: none;padding-left: 0;">
                                                            <li>Correo: {{ $pedido->correo }}</li>
                                                            <li>Nombre: {{ $pedido->nombre }}</li>
                                                            <li>Teléfono: {{ $pedido->telefono }}</li>
                                                            <li>Fecha: {{ $pedido->fecha }}</li>
                                                            <li>Calle: {{ $pedido->calle }}</li>
                                                            <li>Colonia: {{ $pedido->colonia }}</li>
                                                            <li>C.P.: {{ $pedido->cp }}</li>
                                                            <li>Ciudad: {{ $pedido->ciudad }}</li>
                                                            <li>Estado: {{ $pedido->estado }}</li>
                                                            <li style="background-color:#66FDAD">Total: ${{ $pedido->total }}</li>
                                                        </ul>
                                                       </div>
                                                       <div class="col-md-6 table-responsive" >
                                                           <h6>Lista de Artículos: </h6>
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <th>Cod</th>
                                                                    <th>Nombre</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($articulos as $articulo)
                                                                    @if($pedido->id==$articulo->id_cliente)
                                                                    <tr>
                                                                        <th>{{ $articulo->codigo }}</th>
                                                                        <th>{{ $articulo->nombre }}</th>
                                                                        <th>{{ $articulo->cantidad }}</th>
                                                                        <th>{{ $articulo->precio }}</th>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                       </div>
                                                       <div class="col-md-2" >
                                                        <h6>Estado del pedido: </h6>
                                                        <div class="btn-group-vertical">
                                                          <br>
                                                          <button type="button" class="btn btn-warning active" >Pendiente</button>
                                                          <button type="button" class="btn btn-info" disabled="">En Proceso</button>
                                                          <button type="button" class="btn btn-success" disabled="">Entregado</button>
                                                       </div>
                                                       </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @empty
                                                    <h4>No Existen pedidos!!!</h4>
                                                @endforelse
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                            @forelse($pedidos as $pedido)
                                                    @if($pedido->estatus=="procesando")
                                                    <div class="col-md-12">
                                                    <div class="alert alert-dark alert-warning row" data-notify="container" style="color: black;">
                                                       <h5>Pedido número: {{ $pedido->id }}</h5>
                                                       <div class="col-md-12" style="margin-bottom: 2rem;">
                                                        <br>
                                                        <div class="col-md-6">
                                                            <h5>Número de Rastreo: <strong>{{ $pedido->rastreo }}</strong></h5>
                                                        </div>
                                                        <div class="col-md-6 text-right" >
                                                            <form action="{{URL::to('/')}}/entregado/{{ $pedido->id }}" method="POST">
                                                              {{ csrf_field() }}
                                                              {{ method_field('post') }}
                                                              <button class="btn btn-success" type="submit" onclick="return confirm('¿Está seguro de cambiar el estatus del pedido?')">Cambiar a <i class="ti-check"></i></button>
                                                            </form>
                                                        </div>
                                                       </div>
                                                       <div class="col-md-4" >
                                                        <h6>Datos del Cliente: </h6>
                                                        <ul style="list-style-type: none;padding-left: 0;">
                                                            <li>Correo: {{ $pedido->correo }}</li>
                                                            <li>Nombre: {{ $pedido->nombre }}</li>
                                                            <li>Teléfono: {{ $pedido->telefono }}</li>
                                                            <li>Fecha: {{ $pedido->fecha }}</li>
                                                            <li>Calle: {{ $pedido->calle }}</li>
                                                            <li>Colonia: {{ $pedido->colonia }}</li>
                                                            <li>C.P.: {{ $pedido->cp }}</li>
                                                            <li>Ciudad: {{ $pedido->ciudad }}</li>
                                                            <li>Estado: {{ $pedido->estado }}</li>
                                                            <li style="background-color:#66FDAD">Total: ${{ $pedido->total }}</li>
                                                        </ul>
                                                       </div>
                                                       <div class="col-md-6 table-responsive" >
                                                           <h6>Lista de Artículos: </h6>
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <th>Cod</th>
                                                                    <th>Nombre</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($articulos as $articulo)
                                                                    @if($pedido->id==$articulo->id_cliente)
                                                                    <tr>
                                                                        <th>{{ $articulo->codigo }}</th>
                                                                        <th>{{ $articulo->nombre }}</th>
                                                                        <th>{{ $articulo->cantidad }}</th>
                                                                        <th>{{ $articulo->precio }}</th>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                       </div>
                                                       <div class="col-md-2" >
                                                        <h6>Estado del pedido: </h6>
                                                        <div class="btn-group-vertical">
                                                          <br>
                                                          <button type="button" class="btn btn-warning " disabled="">Pendiente</button>
                                                          <button type="button" class="btn btn-info active" >En Proceso</button>
                                                          <button type="button" class="btn btn-success" disabled="">Entregado</button>
                                                       </div>
                                                       </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @empty
                                                    <h4>No Existen pedidos!!!</h4>
                                                @endforelse
                                        </div>
                                        <div id="menu2" class="tab-pane fade">
                                            @forelse($pedidos as $pedido)
                                                    @if($pedido->estatus=="entregado")
                                                    <div class="col-md-12">
                                                    <div class="alert alert-dark alert-success row" data-notify="container" style="color: black;">
                                                       <h5>Pedido número: {{ $pedido->id }}</h5>
                                                       <div class="col-md-4" >
                                                        <h6>Datos del Cliente: </h6>
                                                        <ul style="list-style-type: none;padding-left: 0;">
                                                            <li>Correo: {{ $pedido->correo }}</li>
                                                            <li>Nombre: {{ $pedido->nombre }}</li>
                                                            <li>Teléfono: {{ $pedido->telefono }}</li>
                                                            <li>Fecha: {{ $pedido->fecha }}</li>
                                                            <li>Calle: {{ $pedido->calle }}</li>
                                                            <li>Colonia: {{ $pedido->colonia }}</li>
                                                            <li>C.P.: {{ $pedido->cp }}</li>
                                                            <li>Ciudad: {{ $pedido->ciudad }}</li>
                                                            <li>Estado: {{ $pedido->estado }}</li>
                                                            <li style="background-color:#FEACF9">Total: ${{ $pedido->total }}</li>
                                                        </ul>
                                                       </div>
                                                       <div class="col-md-6 table-responsive" >
                                                           <h6>Lista de Artículos: </h6>
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <th>Cod</th>
                                                                    <th>Nombre</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($articulos as $articulo)
                                                                    @if($pedido->id==$articulo->id_cliente)
                                                                    <tr>
                                                                        <th>{{ $articulo->codigo }}</th>
                                                                        <th>{{ $articulo->nombre }}</th>
                                                                        <th>{{ $articulo->cantidad }}</th>
                                                                        <th>{{ $articulo->precio }}</th>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                       </div>
                                                       <div class="col-md-2" >
                                                        <h6>Estado del pedido: </h6>
                                                        <div class="btn-group-vertical">
                                                          <br>
                                                          <button type="button" class="btn btn-warning " disabled="">Pendiente</button>
                                                          <button type="button" class="btn btn-info" disabled="">En Proceso</button>
                                                          <button type="button" class="btn btn-success active" >Entregado</button>
                                                       </div>
                                                       </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @empty
                                                    <h4>No Existen pedidos!!!</h4>
                                                @endforelse
                                        </div>
                                      </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection