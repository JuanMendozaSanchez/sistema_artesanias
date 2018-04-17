@extends('layouts.app')

@section('title','Catalogo de productos')

@section('content')

  <div class="container ">
    <div class="row fondo-prod">
      <!-- begin row-->
      <div class="col-md-12">
        
        <link rel="stylesheet" href=" {{ asset('css/page/webpage.css')}}">

        <!-- MAIN (Center website) -->
        <div class="main">

        <h1>PRODUCTOS</h1>
        <hr>

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
              <a href="#" data-toggle="tooltip" title="{{ $producto->nombre }}"><img class=" img-thumbnail alto-img zoom" src="{{asset('img/productos')}}/{{ $producto->ruta }}" alt="{{ $producto->nombre }}" style="width: 90%"></a>
              <div class="card-body">
                <h4 class="card-title text-left">
                  {{ $producto->nombre }}
                </h4>
                <p class="card-text text-left">{{ $producto->categoria }}</p>
                <p class="card-text text-left">Precio: $ {{ $producto->precio_venta }}</p>
                <p class="card-text text-left">{{ $producto->descripcion }}</p>
                <p class="card-text text-left">Piezas disponibles: {{ $producto->existencia }}</p>
              </div>
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

      

      <script src="{{ asset('js/page/webpage.js') }}" defer></script>
  
@endsection
