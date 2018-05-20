@component('mail::message')
# Gracias por su compra estimado cliente 

#Lista de artículos 

Nombre  | Cantidad | Precio  
--------------|-------------- |--------------
@for($i=0;$i < count($articulos->articulo);$i++)
	@if($articulos->articulo[$i]!=null)
		{{ $articulos->articulo[$i]->nombre }}  | {{ $articulos->articulo[$i]->cantidad }} | {{ $articulos->articulo[$i]->precio }}
	@endif
@endfor

## Total: ${{ $total }}
## Fecha de compra: {{ $fecha }}

@component('mail::button', ['url' => ''])
Ir a la WEB
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
