<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;
use Illuminate\Support\Facades\Input;

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
    	//e(Input::get('fechaI'));

		//$articulos=json_decode($articulos, true);
		//$datosBuyer=json_decode($datosBuyer, true);

		$articulos=json_decode( html_entity_decode( stripslashes ($articulos ) ));
		$datosBuyer=json_decode( html_entity_decode( stripslashes ($datosBuyer ) ));
		//$datosBuyer=json_decode(json_encode($datosBuyer), true);
		for ($i=0; $i < count($articulos); $i++) { 
			//$articulos[0];
			//artGuardados['articulo'][i].numFila
		}

    	//dd($articulos->articulo[0],$total,$datosBuyer->email);
    	//dd(count($articulos->articulo),$total,$datosBuyer->email);
    	return view('paginaWeb.datosBuyer')->with('articulos',$articulos)->with('datosCliente',$datosBuyer)->with('total',$total);
    }

    public function recibiendoDatosCC(Request $request){
    	$token=$request->input("token");
    	$paymentMethod=$request->input('paymentMethodId');
    	$email=$request->input('email');

    	

    	//dd($payment);

    	//dd($token,$paymentMethod,$email);
    }

    //funcion que no es utilizada, proxima a ser eliminada
    public function mostrarCar(){
    	return view('paginaWeb.carrito');
    }


}
