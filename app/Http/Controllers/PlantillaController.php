<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;
use SistemaLaOax\Producto;
use SistemaLaOax\Venta;
use SistemaLaOax\DetalleVenta;
use Lava;
use DB;


class PlantillaController extends Controller
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

    public function perfilUsuario(){
    	return view('plantilla.user');
    }
    

    public function graficas(){
    	$ventasData = Lava::DataTable();
    	$productosData = Lava::DataTable();

		$ene=Venta::whereMonth('fecha','01')->count();
		$feb=Venta::whereMonth('fecha','02')->count();
		$mar=Venta::whereMonth('fecha','03')->count();
		$abr=Venta::whereMonth('fecha','04')->count();
		$may=Venta::whereMonth('fecha','05')->count();
		$jun=Venta::whereMonth('fecha','06')->count();
		$jul=Venta::whereMonth('fecha','07')->count();
		$ags=Venta::whereMonth('fecha','08')->count();
		$sep=Venta::whereMonth('fecha','09')->count();
		$oct=Venta::whereMonth('fecha','10')->count();
		$nov=Venta::whereMonth('fecha','11')->count();
		$dic=Venta::whereMonth('fecha','12')->count();


	$ventasData->addStringColumn('Mes')
	           ->addNumberColumn('Ventas 2018')
	          // ->addNumberColumn('Ventas 2019')
	           //->addRow(['Enero', $ene,0])
	           ->addRow(['Enero', $ene])
	           ->addRow(['Febrero', $feb])
	           ->addRow(['Marzo', $mar])
	           ->addRow(['Abril', $abr])
	           ->addRow(['Mayo', $may])
	           ->addRow(['Junio', $jun])
	           ->addRow(['Julio', $jul])
	           ->addRow(['Agosto', $ags])
	           ->addRow(['Septiembre', $sep])
	           ->addRow(['Octubre', $oct])
	           ->addRow(['Noviembre', $nov])
	           ->addRow(['Diciembre', $dic]);

		///datos para producto mas vendido
	    $codigosProductos = DB::table('producto')->select('codigo','nombre')->get();
	    $info2=array();
	    for ($i=0; $i <count($codigosProductos) ; $i++) { 
	    	$cant=DetalleVenta::where('codigo_producto',$codigosProductos[$i]->codigo)->count();
	    	$info2[$i] = array($codigosProductos[$i]->nombre,$cant ,'green', $cant);
	    }
	    $productosData->addStringColumn('Producto')
	           ->addNumberColumn('Vendidos')
	           ->addRoleColumn('string', 'style')
    		   ->addRoleColumn('string', 'annotation')
	           ->addRows($info2);
	    //________________
	    
		$grafica=Lava::AreaChart(
			'Ventas', $ventasData, [
	    		'title' => 'Ventas en el año',
	    		'legend' => [
	        	'position' => 'bottom'
	    		]
			]);

		$graficaP=Lava::ColumnChart(
			'Productos', $productosData, [
	    		'title' => 'Producto más vendido',
	    		'legend' =>'none',
	    		'vAxis' => [
			        'title'=>'Vendidos'
			    ]
			]);

		$grafica->pointSize(5);
		$grafica->fontSize(10);
		return view('plantilla.graficas');
    }
}
