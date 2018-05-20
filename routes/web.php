<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;
use SistemaLaOax\Producto;
use Khill\Lavacharts\Lavacharts;
use SistemaLaOax\Venta;


Route::get('/', function () {
    return view('home');
    //return view('plantilla.dashboard2');
});

//rutas para login
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logueo',function(){
	return view('auth.login');
});



//conjunto de rutas para usuarios
Route::get('/lista_usuarios', 'UserController@mostrar_usuarios');

Route::get('/buscar_user','UserController@buscar');

Route::get('/formulario_usuario', 'UserController@create');

Route::post('/agregar_nuevo_usuario', 'UserController@agregar_nuevo_usuario');

Route::get('/datos_usuarios', 'UserController@listado_usuarios2');

//esta ruta fue creada para solventar un error, proxima a renombrar
Route::get('/nueva_ruta/{id}','UserController@form_editar'); 

Route::post('/modificar_usuario/{id}','UserController@actualizar_usuario');

Route::get('/datos_usuarios2', 'UserController@cargar_listado3');

Route::delete('/eliminar_usuario/{id}','UserController@eliminar_user');
//fin de rutas para usuarios

//rutas temporales para las secciones sidebar
Route::get('/graficas','PlantillaController@graficas');

Route::get('/usuario','PlantillaController@perfilUsuario');

Route::get('pedidos','PlantillaController@pedidosOnline');

Route::post('enviaRastreo','PlantillaController@enviarNumeroRastreo');

Route::post('entregado/{id}','PlantillaController@estatusEntregado');
	


Route::get('/maps',function(){
	return view('plantilla.maps');
})->middleware('auth');





Route::get('/codigosB',function(){
	$productos=Producto::orderBy('nombre','asc')->get();
	return view('plantilla.codigos')->with('productos',$productos);
})->middleware('auth');

Route::get('/reportes',function(){
	return view('plantilla.reportes');
})->middleware('auth');


//rutas para dataTable
Route::get('/tabla2',function(){
	return view('tablas.tabla1');
});

Route::get('/obtener_datos',function(){
	return view('tablas.obtener_datos');
});

Route::post('datos_a','pruebaController@arreglo');

//->middleware('auth');


//_______________________________________
//rutas para la tabla productos

Route::get('/listaProductos', 'Productocontroller@listaProducto');

Route::get('/buscarProducto','Productocontroller@buscarP');

Route::get('/formProducto','ProductoController@formProducto');

Route::post('agregarProducto','ProductoController@agregarProducto');

Route::get('listaModificar', 'ProductoController@listaModificar');

Route::get('/modificarProducto/{id}','ProductoController@formEditar');

Route::post('/actualizarProducto/{id}','ProductoController@realizarActualizacion');

Route::get('entradaProducto','ProductoController@entrada');

Route::post('ejecutarEntrada','ProductoController@actualizar_productos');

Route::get('listadoEliminar', 'ProductoController@listaEliminar');

Route::delete('/eliminarProducto/{id}','ProductoController@eliminarProducto');
////fin rutas para productos

///rutas para categorías
Route::get('categorias','CategoriaController@inicio');

Route::post('agregarCategoria','CategoriaController@agregarCategoria');

Route::get('/modificarCategoria/{id}','CategoriaController@formEditar');

Route::post('/actualizarCategoria/{id}','CategoriaController@realizarActualizacion');

Route::delete('eliminarCategoria/{id}','CategoriaController@eliminarCategoria');
///fin rutas para categorías

///rutas para subcategorías
Route::get('subcategorias','SubcategoriaController@inicio');

Route::post('agregarSubcategoria','SubcategoriaController@agregarSubcategoria');

Route::delete('eliminarporNombre/{nombre}','SubcategoriaController@eliminarSubcategoria');
///fin rutas para subcategorías

///rutas para ventas
Route::get('ventas','VentasController@inicio');

Route::post('realizarVenta','VentasController@guardarVenta');

Route::get('listadoCancelarVenta','VentasController@listadoCancelarVenta');

Route::delete('cancelarVenta/{id}','VentasController@cancelarVenta');

Route::get('listadoCancelarP','VentasController@listadoCancelarProducto');

Route::delete('cancelarProducto/{id}','VentasController@cancelarP');

Route::get('buscarFolioV','VentasController@buscarFolioVenta');



///////////fin rutas venta



/////prueba select
Route::get('dropdown', function(){
	$id = Input::get('option');
	dd($id);
	$procesos = Categoria::find($id)->subcategorias;
	return $procesos->lists('nombre', 'sub_id');
});

///_________________________________________-
//ruta para genrar reportes pdf
Route::get('verReporteVentas/{idUsuario}/{tipo}','PdfController@crearReporteVentas');

Route::get('reporteVentasBetween/{tipo}','PdfController@reporteVentasBetween');

Route::get('reporteVentasHoy/{tipo}','PdfController@reporteVentasHoy');

Route::get('reporteVentasMensual/{tipo}/{mes}','PdfController@reporteVentasMensual');

Route::get('reporteVentasAnual/{tipo}','PdfController@reporteVentasAnual');

Route::get('reporteVentasGral/{tipo}','PdfController@reporteVentasGral');

//Ruta para generar codigos de barra
Route::get('generarCodigoB/{codigo}/{tipo}','PdfController@generarBC');

///_________________________________________-
//ruta para vistas de reportes 
Route::get('vistaVentas','ReporteController@ventas');


///____________________________________
//rutas para carrito
Route::get('mostrarCar','PageController@mostrarCar');

Route::post('datosPayer','PageController@datosPayer');

Route::post('finalizarCompra','PageController@finalizarCompra');

//__________________________________________
//rutas para pagina web de inicio 
Route::get('webProductos','PageController@seccionProductos');

Route::get('checarCambios','PlantillaController@verificaCambios');





