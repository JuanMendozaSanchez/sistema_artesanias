<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Venta;

class ReporteController extends Controller
{
    public function ventas(){
    	$ventas=Venta::orderBy('folio', 'desc')->paginate(10);
    	return view('vistasReportes.vistaVenta')->with('ventas',$ventas);
    }
}
