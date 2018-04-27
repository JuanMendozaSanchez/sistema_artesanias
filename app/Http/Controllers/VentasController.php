<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Venta;
use SistemaLaOax\DetalleVenta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;

class VentasController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
    	$ventas=Venta::all();
    	//dd($ventas);
    	if ($ventas->count()!=0) {
    		$ventas=Venta::orderBy('folio','desc')->first();
    		$ventas=$ventas->folio+1;
    	}else{
    		$ventas=1;
    	}
    	
    	$productos=Producto::all();
    	return view('ventas.ventas')->with('productos',$productos)->with('ventas',$ventas);
    }

    public function guardarVenta(Request $request){
    	$date=Carbon::now();
    	//dd($date);
    	$fechaVenta = $date;
	    $idUsuario = Auth::user()->id;
	    $nombreUsuario = Auth::user()->name;
	    $fol = e(Input::get('folioo'));
	    $subt = e(Input::get('subtotal2'));
	    $tot = e(Input::get('total2'));
	    $efectivo = e(Input::get('efectivo'));
	    $cambio = e(Input::get('cambio2'));
	    //$nombreUsuario = e(Input::get('descripcion'));


	   //try {
				$venta= new Venta;
				$venta->folio=$fol;
				$venta->fecha=$fechaVenta;
				$venta->id_usuario=$idUsuario;
				$venta->nombre_usuario=$nombreUsuario;
				$venta->subtotal=floatval($subt);
				$venta->total=floatval($tot);
				$venta->efectivo=floatval($efectivo);
				$venta->cambio=floatval($cambio);

				$resul= $venta->save();
				if ($resul) {
					$ventaActual=Venta::orderBy('id','desc')->first();
	            	//dd($ventaActual);
				    //__________fin codigo para guardar en la tabla ventas

			    	$datos_json = ($request->input('datosVenta'));
					$datos=json_decode($datos_json, true);

					$codigos_json = ($request->input('codigos'));
					$codigos=json_decode($codigos_json, true);

					DB::table('detalle_venta')->insert($datos);

					//ciclo para restar los productos que se vendieron
					for ($i=0; $i < count($codigos) ; $i++) { 
						DB::table('producto')->where('codigo', array_get($codigos[$i], 'codigo'))->update($codigos[$i]);
					}
					\Session::flash('mensaje','Venta realizada con éxito!!!');

			        return redirect('ventas');
				}else{
					\Session::flash('mensaje','Ocurrio algún error al intentar guardar la venta!!!');
                	return redirect('ventas');
				}
            /*} catch (\Exception $e) {
                \Session::flash('mensaje','Ocurrio algún error!!!');
                return redirect('ventas');
            }*/
            

    }

    public function listadoCancelarVenta(){
    	$ventas=Venta::orderBy('folio','desc')->get();

        return view('ventas.listadoCancelar')->with('ventas',$ventas);
    }

    public function cancelarVenta($id){
    	try {
            $venta=Venta::findOrFail($id);
            $venta->delete();
            \Session::flash('mensaje','La venta '.$venta->folio.' fue cancelada con exito!');
            $ventas=Venta::orderBy('folio','desc')->get();

            return redirect('listadoCancelarVenta')->with('ventas',$ventas);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
