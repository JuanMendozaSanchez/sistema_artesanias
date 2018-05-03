<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use SistemaLaOax\Venta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function downloadPDF()

    {
        $productos=\SistemaLaOax\Producto::all();
        $ventas=Venta::all();
        //$pdf = PDF::loadView('ventas.ventas',compact('productos','ventas'));
        //$data = $this->getData();
        //$date = date('Y-m-d');
        //$invoice = "2222";
        //$view =  \View::make('ventas.ventas', compact('productos', 'ventas'))->render();
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->loadHTML($view);
        $pdf =PDF::loadView('ventas.listadoCancelar',compact('ventas'));
        return $pdf->stream('invoice.pdf');

        //return $pdf->stream('invoice.pdf');

    }
}
