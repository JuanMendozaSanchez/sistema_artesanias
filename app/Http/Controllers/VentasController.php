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
    	return view('ventas.principal')->with('productos',$productos)->with('ventas',$ventas);
    }

    public function guardarVenta(Request $request){
    	$date=Carbon::now();
    	//dd($date);
    	$fechaVenta = $date;
	    $idUsuario = Auth::user()->id;
	    $nombreUsuario = Auth::user()->name;
	    $fol = e(Input::get('folioo'));
	    //$nombreUsuario = e(Input::get('descripcion'));


	   try {
				$venta= new Venta;
				$venta->folio=$fol;
				$venta->fecha=$fechaVenta;
				$venta->id_usuario=$idUsuario;
				$venta->nombre_usuario=$nombreUsuario;
				//$venta->precio_compra=$pCompra;

				$resul= $venta->save();
                /*if($resul){
		            
                    \Session::flash('mensaje','Venta realizada con éxito!!!');

                    return redirect('ventas');
				}
				else
				{
		             
		            return 'Ocurrio algún error vuelva a intentarlo por favor';  

				}*/

            } catch (\Exception $e) {
                \Session::flash('mensaje','Ocurrio algún error!!!');
                return redirect('ventas');
            }
            $ventaActual=Venta::orderBy('id','desc')->first();
            //dd($ventaActual);
	    //__________fin codigo para guardar en la tabla ventas

    	$datos_json = ($request->input('datosVenta'));
		$datos=json_decode($datos_json, true);

		$codigos_json = ($request->input('codigos'));
		$codigos=json_decode($codigos_json, true);

		DB::table('detalle_venta')->insert($datos);
		for ($i=0; $i < count($codigos) ; $i++) { 

			DB::table('producto')->where('codigo', array_get($codigos[$i], 'codigo'))->update($codigos[$i]);
		}
		\Session::flash('mensaje','Venta realizada con éxito!!!');

        return redirect('ventas');

    }
}
