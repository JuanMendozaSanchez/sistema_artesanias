@extends('layouts.app')

@section('title','Catalogo de productos')

@section('content')
<link rel="stylesheet" href=" {{ asset('css/page/webpage.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('ShopingCartSource/css/cart.css') }}">
@if(Session::has('mensaje'))
          <div class="col-md-3"></div>
          <div class="alert alert-Success alert-dismissible text-center col-md-6 bg-info" style="font-size: 1.5rem; z-index: 100">
              <a class="close" data-dismiss="alert" aria-label="close" style="font-weight: bold;font-size:2rem;">&times;</a>
              <h4 class="text-center">{{ Session::get('mensaje') }}</h4>
          </div>
        <div class="col-md-3"></div>               
@endif

  <div class="container ">
    <div class="row fondo-prod">
      <!-- begin row-->
      <div class="col-md-12">
        
        

        <!-- MAIN (Center website) -->
        <div class="main">
        <h1>PRODUCTOS</h1>
        
        <hr>
        
        
        <a class="cart_anchor" data-toggle="modal" data-target="#myModal"><span class="badge" id="etiCant"></span></a>

        <h2>CATEGORIAS</h2>
        <input type="hidden" id="subcat" value="{{ $subcategorias }}">
        <div id="myBtnContainer" class="col-sm-10">
          <button class="btn active btn-default dropdown-toggle " onclick="filterSelection('all')" id="btnMain"> Mostrar todo <span class="badge ">{{ $productos->count() }}</span></button>
          @forelse($categorias as $categoria)
            <button class="btn btn-default cate" value="{{ $categoria->id }}" onclick="filterSelection('{{ $categoria->nombre }}')" > {{ $categoria->nombre }} <span class="badge">{{$productos->where('categoria',$categoria->nombre)->count()}}</span></button>

          @empty
            <p>No hay categorias</p>
          @endforelse
        <hr>
        </div>
        <div class="col-sm-2 text-center">
          <button type="button" class="btn btn-warning top-marg" id="filtro"><span class="glyphicon glyphicon-chevron-down"></span> Filtrar</button> 
            
          <div class="collapse">
            <select class="form-control top-marg" name="subcategoria" id="subopt">
              <option value="sin subcategoria">Selecciona una categoria</option>
            </select>
            <hr>
          </div>
        


        <!-- END MAIN -->
        </div>
        

          

        </div>
      </div>

      

      <div class="row col-md-12">
        

        @forelse($productos as $producto)
          <div class="column {{ $producto->categoria }} {{ $producto->subcat }} col-lg-3 col-md-4 col-sm-6 portfolio-item ">
            <div class="content ">
            <div class="card text-center">

              <a data-toggle="tooltip" title="{{ $producto->nombre }}"><img class=" img-thumbnail alto-img zoom" src="{{asset('img/productos')}}/{{ $producto->ruta }}" alt="{{ $producto->nombre }}" style="width: 90%"></a>
              <div class="card-body">
                <h4 class="card-title text-left">
                  {{ $producto->nombre }}
                </h4>
                <input type="hidden" id="code" value="{{ $producto->codigo }}">
                <input type="hidden" id="prod" value="{{ $producto->nombre }}">
                <p class="card-text text-left">{{ $producto->categoria }}</p>
                <p class="card-text text-left" >Precio: $ {{ $producto->precio_venta }}</p>
                <input type="hidden" id="precio" value="{{ $producto->precio_venta }}">
                <p class="card-text text-left">{{ $producto->descripcion }}</p>
                <p class="card-text text-left">Piezas disponibles: {{ $producto->existencia }}</p>
              </div>
              <a href="javascript:void(0);" class="add-to-cart miBtn" >Agregar <img src="{{ asset('img/muestra/add.png') }}" id="addP"></a>
            </div>
          </div>
          </div>
        @empty
          <p>No hay productos</p>
        @endforelse
      </div>
      


      <!--end row-->
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" id="cerrarM1">&times;</button>
          <h4 class="modal-title">Artículos agregados al carrito</h4>
        </div>
        <div class="modal-body tabla" >
          <table id="tabla" class="table table-sm">
            <thead >
              <tr>
                <td></td>
                <td>Imagen</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="totalFinal" >
            <label>Total: $</label>
            <span id="totalFinal">$ 00.00</span>
          </div>
          <div class="col-md-12 text-center" id="mensajeParaBuyer">
            <div class="alert alert-info ">
              <p style="font-size: 2rem;"><strong>Gracias por su compra!!!</strong> Para finalizar satisfactoriamente por favor confirme sus datos.</p>
                <form method="post" action="datosPayer"  onsubmit="ocultar()">
                  @csrf
                  <input type="hidden" name="cargaArticulos" id="cargaArticulos">
                  <input type="hidden" name="cargaTotal" id="cargaTotal">
                  <input type="hidden" name="cargaBuyer" id="cargaBuyer">
                  <button type="submit" class="btn btn-success btn-lg btn-block">Continuar</button>
                </form>
                <!--<a href="datosPayer" target="blank"><span class="glyphicon glyphicon-send" style="font-size: 2rem">Continuar</span></a></strong>-->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-6">
            <button class="btn btn-danger" id="vaciar">Vaciar <span class="glyphicon glyphicon-shopping-cart"></span></button>
            <button type="button" class="btn btn-info" data-dismiss="modal" id="seguir">Seguir Comprando</button>
          </div>
          <div class="col-md-6">
            <div id="paypal-button"></div>
          </div>
          
        </div>
      </div>
      
    </div>
  </div><!-- Modal -->

  

  


      <script src="{{ asset('js/page/webpage.js') }}" defer></script>
      <!--script para funciones del carrito de compras-->
      <script type="text/javascript" src="{{ asset('ShopingCartSource/js/cart.js') }}"></script>
      
      <!--Scripts para pagar en linea con paypal-->
      <script src="https://www.paypalobjects.com/api/checkout.js"></script>
      <script type="text/javascript" src="{{ asset('ShopingCartSource/js/paypal.js') }}"></script>

      <script type="text/javascript">
        $('#mensajeParaBuyer').hide();
        $('#cerrarM1').hide();
        function ocultar(){
          $('#mensajeParaBuyer').hide();
          $('#seguir').show();
          $('#vaciar').show();
        }
      </script>

@endsection
