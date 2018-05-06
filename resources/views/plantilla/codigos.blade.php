
@extends('plantilla.dashboard')

@section('title', 'Generar BC')

@section('contenido')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Generar Códigos de Barras</h4>
                                <p class="category">En esta sección se muestran todos los productos existentes, para poder ver su codigo de barras respectivo, hacer clic sobre el icono de código de barra.</p>
                            </div>
                            <div class="content all-icons">

                        		<div class="icon-section">
                        			<h4>Productos existentes</h4>
                                          @forelse ($productos as $producto)
                                                <div class="icon-container">
                                                      <span>{{ $producto->codigo }}</span>
                                                      <span class="icon-name">{{ $producto->nombre }}</span>
                                                      <a href="generarCodigoB/{{$producto->codigo}}/1" target="_blank"><span class="glyphicon glyphicon-barcode" style="margin-left: 1rem;font-size: 2rem;color:green;"></span>
                                                      </a>
                                                </div>
                                            @empty
                                                <li>No hay productos registrados.</li>
                                            @endforelse
                        		</div> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection