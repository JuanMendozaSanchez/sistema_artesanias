<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Categoria;

use SistemaLaOax\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProductoController extends Controller
{
	//funcionando
	public function listaProducto(){
		$productos=Producto::paginate(5);
		$busqueda=0;

		return view('productos.lista')->with('productos',$productos)->with('busqueda',$busqueda);
	}

	//funcionando
	public function buscarP(Request $request){
        //$usuarios=User::paginate(5);
        $busqueda=1;
        $productos = DB::table('producto')->where('nombre', 'like', '%'.$request->get('nombre').'%')->orderBy('id','DESC')->get();

        return view('productos.lista')->with('productos',$productos)->with('busqueda',$busqueda);
    }

	//funcionando
	public function formProducto(){
		$productos=Producto::paginate(5);
		$categorias=Categoria::all();

		return view('productos.insertar')->with('productos',$productos)->with('categorias',$categorias);
	}

	//funcionando
	public function agregarProducto(Request $request){
		$codigo = e(Input::get('codigo'));
	    $nombre = e(Input::get('nombre'));
	    $descripcion = e(Input::get('descripcion'));
	    $pCompra = e(Input::get('pCompra'));
	    $pVenta = e(Input::get('pVenta'));
	    $cantidad = e(Input::get('cantidad'));
	    $categoria = e(Input::get('categoria'));

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'codigo' => 'unique:producto|required',
	     );

	     //personalizamos los mensajes de error para nuestro formualario
	     $messages = array(
	     	'required'=>'es necesario el campo :atributte ',
		     'unique' => 'El codigo ingresado ya existe en la base de datos'

		 );


        $validacion = \Validator::make($rules, $messages);
        
        if ($validacion->fails())
        {
			 $errores = $validacion->errors(); 
			 return new JsonResponse($errores, 422); 
			 return \Redirect::back()->withInput()->withErrors($errores );		          
        }else{
			try {
				$producto= new Producto;
				$producto->codigo=$codigo;
				$producto->nombre=$nombre;
				$producto->descripcion=$descripcion;
				$producto->precio_compra=$pCompra;
				$producto->precio_venta=$pVenta;
				$producto->existencia=$cantidad;
				$producto->categoria=$categoria;


				$resul= $producto->save();
                if($resul){
		            $productos=Producto::paginate(5);
		            $categorias=Categoria::all();
		            
                    \Session::flash('mensaje','El producto '.$nombre.' fue agregado con exito!');

                    return redirect('formProducto')->with('productos',$productos)->with('categorias',$categorias);
		              
				}
				else
				{
		             
		            return 'Ocurrio algún error vuelva a intentarlo por favor';  

				}

            } catch (\Exception $e) {
                $productos=Producto::paginate(5);
		         $categorias=Categoria::all();
                \Session::flash('mensaje','El codigo '.$codigo.' ya existe!!!');
                return redirect('formProducto')->with('productos',$productos)->with('categorias',$categorias);

            }
			
        }
	}

	//no usado
    public function updateProducto(Request $request){

		$datos_json = ($request->input('datos'));
		$datos=json_decode($datos_json, true);

		$codigos_json = ($request->input('codigos'));
		$codigos=json_decode($codigos_json, true);

		for ($i=0; $i < count($codigos) ; $i++) { 
			DB::table('prueba')->where('nombre', array_get($codigos[$i], 'nombre'))
			->update($datos[$i]);
		}

    }

    //funcionando
    public function entrada(){
    	$productos=Producto::paginate(5);
		$categorias=Categoria::all();

		return view('productos.entrada')->with('productos',$productos)->with('categorias',$categorias);
    }

    //funcionando
    public function actualizar_productos(Request $request)
    {
    	$datos_json = ($request->input('datos'));
		$datos=json_decode($datos_json, true);

		$codigos_json = ($request->input('codigos'));
		$codigos=json_decode($codigos_json, true);

        try
        {
        	for ($i=0; $i < count($codigos) ; $i++) { 
				$resul=DB::table('prueba')->where('nombre', array_get($codigos[$i], 'nombre'))
				->update($datos[$i]);

			}
            

            if($resul){
                $productos=Producto::paginate(5);
                $categorias=Categoria::all();
                \Session::flash('mensaje','Los productos fueron agregados con exito!');
                return redirect('/formProducto')->with('productos',$productos)->with('categorias',$categoria);
                          
            }
            else
            {
                         
                return 'Ocurrio algún error vuelva a intentarlo por favor';  

            }
        }catch(\Exception $e){
            \Session::flash('mensaje','Por favor verificar los datos!!!');
            return redirect('entradaProducto');
        }
        
    }
}
