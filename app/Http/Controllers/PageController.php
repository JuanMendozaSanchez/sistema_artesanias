<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;

class PageController extends Controller
{
    public function seccionProductos(){
    	$productos = Producto::all();
    	//dd($productos->count());

    	$categorias=Categoria::all();
    	$subcategorias=Subcategoria::all();
    	return view('paginaWeb.productos')->with('productos',$productos)->with('categorias',$categorias)->with('subcategorias',$subcategorias);
    }

    public function mostrarCar(){
    	return view('paginaWeb.carrito');
    }
}
