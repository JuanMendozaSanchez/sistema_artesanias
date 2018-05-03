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
//use Barryvdh\DomPDF\Facade as PDF;
//use Illuminate\Support\Facades\PDF;



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


    	/*$codigos_json = ($request->input('codigos'));
					$codigos=json_decode($codigos_json, true);
						$canti=intval(array_get($codigos[0], 'cantidad'));
						dd($canti);*/

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
						$canti=intval(array_get($codigos[$i], 'cantidad'));
						DB::table('producto')->where('codigo', array_get($codigos[$i], 'codigo'))->decrement('existencia',$canti);
					}

                    ///llamar a la funcion para crear el ticket
                    $this->crearTicket($idUsuario,$datos,'reportes.ticketV');

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
            //dd($venta->folio);
            $folio=$venta->folio;

            $productos=DB::table('detalle_venta')->select( 'detalle_venta.folio','codigo_producto as cp','cantidad')
				->join('venta', function ($join) use ($folio) {
					    $join->on('venta.folio', '=', 'detalle_venta.folio')
					         ->where('venta.folio', '=', $folio);
				   })->get();

			foreach ($productos as $prod) {
            	DB::table('producto')
            	->where('codigo', $prod->cp)->increment('existencia', $prod->cantidad);
			}
			
            $venta->delete();
            \Session::flash('mensaje','La venta '.$venta->folio.' fue cancelada con exito!');
            $ventas=Venta::orderBy('folio','desc')->get();

            return redirect('listadoCancelarVenta')->with('ventas',$ventas);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function listadoCancelarProducto(){
    	$detallesV=DetalleVenta::orderBy('folio','desc')->get();
        return view('ventas.listadoCancelarP')->with('detalles',$detallesV);
    }

    public function buscarFolioVenta(Request $request){
    	$productos = DB::table('detalle_venta')->where('folio', $request->get('folio'))->orderBy('nombre_producto','DESC')->get();

        return view('ventas.listadoCancelarP')->with('detalles',$productos);
    }

    public function cancelarP($id){
    	try {
            $detalleVenta=DetalleVenta::findOrFail($id);

            Producto::where('codigo',$detalleVenta->codigo_producto)->increment('existencia', $detalleVenta->cantidad);

            
            Venta::where('folio',$detalleVenta->folio)->decrement('subtotal', $detalleVenta->total);

            $venta=Venta::where('folio',$detalleVenta->folio)->first();
            Venta::where('folio',$detalleVenta->folio)->update(['total'=> $venta->subtotal+($venta->subtotal*0.16),'cambio'=>$venta->efectivo-($venta->subtotal+($venta->subtotal*0.16))]);


            //dd('hecho');

            $detalleVenta->delete();
            \Session::flash('mensaje','El producto '.$detalleVenta->nombre_producto.' fue cancelado con exito!');
            $detallesV=DetalleVenta::orderBy('folio','desc')->get();

            return redirect('listadoCancelarP');
        } catch (\Exception $e) {
            abort(404);
        }
    }

public function crearTicket($idUsuario,$datos,$vistaurl)
    {

        $data = $datos;
        $date = Carbon::now();
        $usuario=Auth::user()->name;
        $nombre_archivo = "tickets/venta.txt"; 
 
        if(file_exists($nombre_archivo))
        {
            unlink('tickets/venta.txt');
            
            $mensaje = "El Archivo $nombre_archivo se ha modificado \n";
            $mensaje=$mensaje."Codigo | producto | cantidad |precio unitario| precio final \n";
            for ($i=0; $i < count($data) ; $i++) { 
               $mensaje = $mensaje.array_get($data[$i], 'codigo_producto')."\t";
               $mensaje = $mensaje.array_get($data[$i], 'nombre_producto')."\t \t \t";
               $mensaje = $mensaje.array_get($data[$i], 'cantidad')."\t \t";
               $mensaje = $mensaje.array_get($data[$i], 'precio_unitario')."\t \t";
               $mensaje = $mensaje.array_get($data[$i], 'total')."\n";
            }

        }
     
        else
        {
            $mensaje = "El Archivo $nombre_archivo se ha creado \n";
            $mensaje= "Codigo | producto | cantidad |precio unitario| precio final \n";
            for ($i=0; $i < count($data) ; $i++) { 
               $mensaje = $mensaje.array_get($data[$i], 'codigo_producto')."\t";
               $mensaje = $mensaje.array_get($data[$i], 'nombre_producto')."\t \t \t";
               $mensaje = $mensaje.array_get($data[$i], 'cantidad')."\t \t";
               $mensaje = $mensaje.array_get($data[$i], 'precio_unitario')."\t \t";
               $mensaje = $mensaje.array_get($data[$i], 'total')."\n";
           }
        }
     
        if($archivo = fopen($nombre_archivo, "a"))
        {
            if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
            {
                //echo "Se ha ejecutado correctamente";
            }
            else
            {
                //echo "Ha habido un problema al crear el archivo";
            }
     
            fclose($archivo);
        }

    }

}
