@extends('layouts.app')

@section('title','Inicio')

@section('content')
  
  <script src="{{ asset('js/slippry.min.js') }}"></script>

  <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    
  <link rel="stylesheet" href="{{ asset('css/slippry.css') }}">

  <div class="container">
<div class="row">
  <div class="col-sm-8 ">
    <div class="content img-alto">
      <ul id="galeria1" >
            <li>
              <a href="#slide1">
                <img class="alto" src="{{ asset('img/muestra/uno.jpg')}}" alt="Descripción breve 1 <a href='#link'>Link si se desea!</a>">
              </a>
            </li>
            <li>
              <a href="#slide2">
                <img class="alto" src="{{ asset('img/muestra/dos.jpg')}}"  alt="Descripción breve 2">
              </a>
            </li>
            <li>
              <a href="#slide3">
                <img class="alto" src="{{ asset('img/muestra/tres.jpg')}}" alt="Descripción breve 3.">
              </a>
            </li>
            <li>
              <a href="#slide4">
                <img class="alto" src="{{ asset('img/muestra/tres.jpg')}}" alt="Descripción breve 4.">
              </a>
            </li>
          </ul>
    </div>
    
  </div>
  <div class="col-sm-4">
    <br>
    <br>
    <br>
    <div class="well">
      <p>Some text..</p>
    </div>
    <div class="well">
       <p>Upcoming Events..</p>
    </div>
    <div class="well">
       <p>Visit Our Blog</p>
    </div>
  </div>
</div>
<br>
<br>
<hr>
</div>

<div class="container text-center">    
  <h3>What We Do</h3>
  <br>
  <div class="row">
    <div class="col-sm-3">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-3"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>    
    </div>
    <div class="col-sm-3">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>  
  </div>
  <hr>
</div>

<div class="container text-center">    
  <h3>Our Partners</h3>
  <br>
  <div class="row">
    <div class="col-sm-2">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 1</p>
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 2</p>    
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 3</p>
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 4</p>
    </div> 
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 5</p>
    </div>     
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 6</p>
    </div> 
  </div>
</div><br>
<script>
  //agregar una linea para cada galeria cambiando el id de la galeria
  jQuery('#galeria1').slippry();
</script>
@endsection
