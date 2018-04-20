<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Categoria;

class CategoriaController extends Controller
{
    public function inicio(){
    	$categorias=Categoria::all();
    	return view('categorias.principal')->with('categorias',$categorias);
    }
}
