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
use SistemaLaOax\OnlineArticulos;
use SistemaLaOax\OnlineCliente;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;


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

    public function pedidosOnline(){
    	$pedidos=OnlineCliente::orderBy('id','DESC')->get();
    	$articulos=OnlineArticulos::all();
    	return view('plantilla.pedidosOnline')->with('pedidos',$pedidos)->with('articulos',$articulos);
    }

    //funcion para ver si existen cambios en la base de datos y notificarlos
    public function verificaCambios(Request $request){
        $pedidos=OnlineCliente::all();
        //dd($pedidos->count());
        $existentes=$pedidos->count();
        $anteriores=$request->data;

        $cambio="si";

        if($request->ajax()){
        	if ($existentes>$anteriores) {
        		//return $cambio;
        		return response()->json(['cambio' => $cambio,'cantidad'=>$existentes,'anteriores'=>$anteriores]);
        	}
            
        }
    }

    //función para enviar el número de rastreo al correo del cliente y cambiar el estatus del pedido a en proceso
    public function enviarNumeroRastreo(Request $request){
    	$id=e(Input::get('id'));
    	$correo=e(Input::get('correo'));
    	$rastreo=e(Input::get('rastreo'));
    	//dd($id,$correo,$rastreo);

    	Mail::to($correo)->send(new \SistemaLaOax\Mail\EnviarRastreo($rastreo));

    	$pedido=OnlineCliente::find($id);
    	$pedido->estatus="procesando";
    	$pedido->rastreo=$rastreo;
    	$pedido->save();

    	\Session::flash('mensaje','El número de rastreo ha sido enviado al cliente!!!');
    	return redirect('pedidos');
    }

    public function estatusEntregado($id){
    	$pedido=OnlineCliente::find($id);
    	$pedido->estatus="entregado";
    	$pedido->save();
    	\Session::flash('mensaje','El estatus cambió a entregado!!!');
    	return redirect('pedidos');
    }
}
