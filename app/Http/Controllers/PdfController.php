<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Venta;
use SistemaLaOax;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 
use SistemaLaOax\Producto;

class PdfController extends Controller
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
    
    public function crearPDF($datos,$vistaurl,$tipo,$titulo)
    {

        $data = $datos;
        //$date = date('Y-m-d');
        $date = Carbon::now();
        $usuario=Auth::user()->name;
        //$txt1=StorageController::getTexto1();
        $nombre="reporte_".$usuario."_".$date.".pdf";
        $view =  \View::make($vistaurl, compact('data','date','usuario','titulo'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);//->setPaper('a4', 'landscape');
        if ($tipo==1) {
        	return $pdf->stream($nombre);
        }elseif ($tipo==2) {
        	return $pdf->download($nombre);
        }
        
    }


    public function crearReporteVentas($idUsuario,$tipo){

	     $vistaurl="reportes.ventas";
	     $fecha=Carbon::now();
	     $fecha=$fecha->format('Y-m-d');
	     $titulo="";
	     $ventas=Venta::orderBy('folio','desc')
	     				->where(function ($query) use ($idUsuario,$fecha) {
	   							$query->where('id_usuario', $idUsuario)
	        					->whereDate('fecha', $fecha);
						})->get();
	     
	     return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }

    public function reporteVentasBetween(Request $request,$tipo){

	     $vistaurl="reportes.ventasBetween";
	     $fechaI = e(Input::get('fechaI'));
	     $fechaF = e(Input::get('fechaF'));
	     $titulo="del ".$fechaI." al ".$fechaF;
	     //dd($fechaI,$fechaF);
	     //$fecha=Carbon::now();
	     //$fecha=$fecha->format('Y-m-d');
	     $ventas=Venta::orderBy('folio','desc')
	     				->where(function ($query) use ($fechaI,$fechaF) {
	   							$query->whereDate('fecha', '>=',$fechaI)
	        					->whereDate('fecha','<=', $fechaF);
						})->get();
	     //dd($ventas);
	     return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }

    public function reporteVentasHoy($tipo){

	     $vistaurl="reportes.ventas";
	     $fecha=Carbon::now();
	     $fecha=$fecha->format('Y-m-d');
	     $titulo="al día ".$fecha;
	     $ventas=Venta::orderBy('folio','desc')->whereDate('fecha', $fecha)->get();
	     
	     return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }

	public function reporteVentasMensual($tipo,$mes){

	    $vistaurl="reportes.ventas";
	    $fecha=Carbon::now();
	    $fecha=$fecha->format('Y');
	    $titulo="al mes ".$mes." del año ".$fecha;
	    //dd($titulo);
	    $ventas=Venta::orderBy('folio','desc')->whereMonth('fecha', $mes)->get();
	     
	    return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }

    public function reporteVentasAnual($tipo){

	    $vistaurl="reportes.ventas";
	    $fecha=Carbon::now();
	    $fecha=$fecha->format('Y');
	    $titulo="al total de ventas realizadas durante el año ".$fecha;
	    //dd($titulo);
	    $ventas=Venta::orderBy('folio','desc')->whereYear('fecha', $fecha)->get();
	     
	    return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }

    public function reporteVentasGral($tipo){

	    $vistaurl="reportes.ventas";
	    $titulo="al total de ventas ";
	    //dd($titulo);
	    $ventas=Venta::orderBy('folio','desc')->get();
	     
	    return $this->crearPDF($ventas, $vistaurl,$tipo,$titulo);
    }
    
    //$q->whereMonth('created_at', '=', date('m'));
    //$users = DB::table('users')->whereBetween('votes', [1, 100])->get();

    ////Codigo de barras
    public function generarBC($codigoProducto,$tipo){
    	 $barra = new DNS1D();
    	 $usuario=Auth::user()->name;
    	 $producto=Producto::where('codigo',$codigoProducto)->first();
    	 $codigo=$codigoProducto;

        $view =  \View::make('codigoBarras.vistaBC', compact('barra','codigo','usuario','producto'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);//->setPaper('a4', 'landscape');
        if ($tipo==1) {
        	return $pdf->stream('Codigo de barras');
        }elseif ($tipo==2) {
        	return $pdf->download('Codigo de barras');
        }
    	 //dd($producto);
    	 //return view('codigoBarras.vistaBC')->with('barra',$barra)->with('codigo',$codigoProducto)->with('usuario',$usuario)->with('nombre',$nombre)->with('producto',$producto);

    	 //echo DNS1D::getBarcodeHTML("4445", "EAN13");
    	 //y si lo vamos a imprimir, ya no seria con getBarcodeHTML sino con getBarcodeSVG
    }//fin codigo de barras
}
