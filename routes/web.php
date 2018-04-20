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
Route::get('/fuentes',function(){
	return view('plantilla.typography');
});

Route::get('/maps',function(){
	return view('plantilla.maps');
});

Route::get('/usuario',function(){
	return view('plantilla.user');
});

Route::get('/tabla',function(){
	return view('plantilla.table');
});

Route::get('/iconos',function(){
	return view('plantilla.icons');
});

Route::get('/notificaciones',function(){
	return view('plantilla.notifications');
});


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
///fin rutas para categorías



/////prueba select
Route::get('dropdown', function(){
	$id = Input::get('option');
	dd($id);
	$procesos = Categoria::find($id)->subcategorias;
	return $procesos->lists('nombre', 'sub_id');
});


//__________________________________________
//rutas para pagina web de inicio 
Route::get('webProductos','PageController@seccionProductos');



