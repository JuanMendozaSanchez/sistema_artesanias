@component('mail::message')

###Le enviamos su número de rastreo para que pueda verificar que su pedido va en camino, Para verlo solo haga clic en el botón Seguir para redireccionar a la página de la paqueteria, una vez ahí, introduzca su número de rastreo para seguir el estatus de su pedido.


#{{ $num }}

@component('mail::button', ['url' => 'google.com'])
Seguir
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
