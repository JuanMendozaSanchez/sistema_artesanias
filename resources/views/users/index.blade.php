@extends('plantilla.dashboard')

@section('title', 'La Oaxaqueña')

@section('contenido')

          <div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="header">
                      <h4 class="title">Tienda de Artesanias "La Oaxaqueña"</h4>
                      <p class="category">Bienvenidos</p>
                    </div>
                    <hr>
                      <div class="col-sm-10 col-sm-offset-1" >
                        <div id="myCarousel" class="carousel slide " data-ride="carousel">
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                          </ol>

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">
                            <div class="item active">
                              <img src="{{ asset('img/muestra/dos.jpg') }}" alt="Image">
                              <div class="carousel-caption">
                                <h3>Sell $</h3>
                                <p>Money Money.</p>
                              </div>      
                            </div>

                            <div class="item">
                              <img src="{{ asset('img/muestra/tres.jpg') }}" alt="Image">
                              <div class="carousel-caption">
                                <h3>More Sell $</h3>
                                <p>Lorem ipsum...</p>
                              </div>      
                            </div>
                          </div>

                          <!-- Left and right controls -->
                          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
@endsection