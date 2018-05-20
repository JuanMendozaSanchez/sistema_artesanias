<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use SistemaLaOax\OnlineCliente;
use SistemaLaOax\OnlineArticulos;
use DB;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function seccionProductos(){
    	$productos = Producto::all();
    	//dd($productos->count());

    	$categorias=Categoria::all();
    	$subcategorias=Subcategoria::all();
        return view('paginaWeb.productos')->with('productos',$productos)->with('categorias',$categorias)->with('subcategorias',$subcategorias);
    	

    }

    public function datosPayer(Request $request){
    	$articulos = e(Input::get('cargaArticulos'));
    	//$articulos=$request->input('cargaArticulos');
    	$total=e(Input::get('cargaTotal'));
    	$datosBuyer=e(Input::get('cargaBuyer'));
    	$fecha = Carbon::now();


		$articulos=json_decode( html_entity_decode( stripslashes ($articulos ) ));
		$datosBuyer=json_decode( html_entity_decode( stripslashes ($datosBuyer ) ));

    	//dd($articulos->articulo[0],$total,$datosBuyer->email);
    	//dd(count($articulos->articulo),$total,$datosBuyer->email);
    	return view('paginaWeb.datosBuyer')->with('articulos',$articulos)->with('datosCliente',$datosBuyer)->with('total',$total)->with('fecha',$fecha);
    }

    public function finalizarCompra(Request $request){
    	$articulos = json_decode($request->input('listaArticulos'));

    	$correo=e(Input::get('correoCliente'));
    	$nombreCliente=e(Input::get('nombreCliente'));
    	$telefono=e(Input::get('telefonoCliente'));
    	$fecha=$request->input('fecha2');
    	//dd($request->input('fecha2'));
    	$calle=e(Input::get('calleCliente'));
    	$colonia=e(Input::get('coloniaCliente'));
    	$cp=e(Input::get('cpCliente'));
    	$ciudad=e(Input::get('ciudadCliente'));
    	$estado=e(Input::get('estadoCliente'));
    	$tot=floatval(e(Input::get('tot')));
    	$estatus_envio='pendiente';

    	try {

			$cliente= new OnlineCliente;
			$cliente->correo=$correo;
			$cliente->nombre=$nombreCliente;
			$cliente->telefono=$telefono;
			$cliente->fecha=$fecha;
			$cliente->calle=$calle;
			$cliente->colonia=$colonia;
			$cliente->cp=$cp;
			$cliente->ciudad=$ciudad;
			$cliente->estado=$estado;
			$cliente->total=$tot;
			$cliente->estatus=$estatus_envio;
            $cliente->rastreo="0";


			$resul=$cliente->save();
             if($resul){
             	$currentCliente=OnlineCliente::where('correo',$correo)->orderby('id','DESC')->first();

		         for($i=0;$i < count($articulos->articulo);$i++){
		            if($articulos->articulo[$i]!=null){
		            	$arti= new OnlineArticulos;
						$arti->id_cliente=$currentCliente->id;
						$arti->codigo=$articulos->articulo[$i]->codigo;
						$arti->nombre=$articulos->articulo[$i]->nombre;
						$arti->cantidad=$articulos->articulo[$i]->cantidad;
						$arti->precio=$articulos->articulo[$i]->precio;
		            	$result2=$arti->save();
		            	
		            	DB::table('producto')->where('codigo', $articulos->articulo[$i]->codigo)->decrement('existencia',$articulos->articulo[$i]->cantidad);
		            	
		            }
		        }
		        Mail::to($correo)->send(new \SistemaLaOax\Mail\NotificarCliente($articulos,$tot,$fecha));

		        \Session::flash('mensaje','Le enviamos un correo con los datos de su compra. Gracias por confiar en nosotros!!!');
                return redirect('webProductos');
			}
			else
			{
		          
		         \Session::flash('mensaje','Revise sus datos. Ocurrio algún error!!!');
    			 return redirect('datosPayer');  

			}
    	} catch (Exception $e) {
    		\Session::flash('mensaje','Revise sus datos. Ocurrio algún error!!!');
    		return redirect('datosPayer');
    	}

    	 

    	dd($articulos->articulo,$nombreCliente);
    	//$articulos=$request->input('cargaArticulos');
    	$total=e(Input::get('cargaTotal'));
    	$datosBuyer=e(Input::get('cargaBuyer'));

    	//dd($payment);

    	//dd($token,$paymentMethod,$email);
    }

    

    //funcion que no es utilizada, proxima a ser eliminada
    public function mostrarCar(){
    	return view('paginaWeb.carrito');
    }


}
