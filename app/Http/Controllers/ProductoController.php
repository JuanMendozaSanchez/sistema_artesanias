<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Producto;
use SistemaLaOax\Categoria;
use SistemaLaOax\Subcategoria;

use SistemaLaOax\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProductoController extends Controller
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
		$subcategorias=Subcategoria::all();

		return view('productos.insertar')->with('productos',$productos)->with('categorias',$categorias)->with('subcat',$subcategorias);
	}

	//funcionando
	public function agregarProducto(Request $request){
       $img = $request->file('file');
       $ruta;
       
		//codigo para imagen
		if (\File::exists($img)) {
			$ext=$img->getClientOriginalExtension();
			//dd($ext);
	        if (strtolower($ext) =='jpg'||strtolower($ext)=='jpeg'||strtolower($ext)=='bmp'||strtolower($ext)=='png') {
				$nombre="img_".e(Input::get('codigo').".".$ext);
				//dd($nombre);
				\Storage::disk('local')->put($nombre,  \File::get($img));
				$ruta=$nombre;
				//dd($ruta);
			}else{
				//$productos=Producto::paginate(5);
		         //$categorias=Categoria::all();
                \Session::flash('mensaje','El formato no es valido. solo se permiten imagenes jpeg, jpg, png o bmp!!!');
				return \Redirect::back();
			}
			    
		}else{
		    $nombre="none.jpg";
			//$img=\Storage::get($nombre);
			$ruta=$nombre;
			//dd($ruta);
		}
		//fin codigo para imagen
 
       


		$codigo = e(Input::get('codigo'));
	    $nombre = e(Input::get('nombre'));
	    $descripcion = e(Input::get('descripcion'));
	    $pCompra = e(Input::get('pCompra'));
	    $pVenta = e(Input::get('pVenta'));
	    $cantidad = e(Input::get('cantidad'));
	    $categoria = e(Input::get('categoria'));
	    $subcategoria = e(Input::get('subcategoria'));
	    //$ruta = $ruta;

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'codigo' => 'unique:producto|required',
	         'img' => 'image|mimes:jpeg,jpg,png,bmp | max:1000',
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

				$ca=Categoria::find($categoria);
				//dd($ca->nombre);

				$producto= new Producto;
				$producto->codigo=$codigo;
				$producto->nombre=$nombre;
				$producto->descripcion=$descripcion;
				$producto->precio_compra=$pCompra;
				$producto->precio_venta=$pVenta;
				$producto->existencia=$cantidad;
				$producto->categoria=$ca->nombre;
				$producto->subcat=$subcategoria;
				$producto->ruta=$ruta;


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

	public function listaModificar(){
		$productos=Producto::paginate(10);
		$busqueda=0;

		return view('productos.listadoModificar')->with('productos',$productos)->with('busqueda',$busqueda);
	}

	public function formEditar($id){
		//funcion para cargar los datos de cada producto en elformulario
        $producto=Producto::find($id);
        $contador=count($producto);
        $categorias=Categoria::all();
        $subcategorias=Subcategoria::all();
        $idCategoria;

        //for para obtener la categoria especifica del producto
        foreach ($categorias as $cate) {
        	if ($producto->categoria==$cate->nombre) {
        		$idCategoria=$cate->id;
        	}
        }

        if($contador>0){        
            return view("productos.actualizar")
                   ->with("producto",$producto)->with('idCategoria',$idCategoria)->with('subcat',$subcategorias)->with('categorias',$categorias);   
        }
        else
        {            
            return 'Algo salio mal';  
        }
	}

	public function realizarActualizacion(Request $request,$id){
		$producto=Producto::find($id);
		$codigo=$producto->codigo;
		$nuevo_categoria;

		//dd($id);
		$nuevo_nombre=e($request->input('inputNombre'));
        $nuevo_descripcion=e($request->input('inputDescripcion'));
        $nuevo_precioC=e($request->input('inputPrecioC'));
        $nuevo_precioV=e($request->input('inputPrecioV'));
        $nuevo_existencia=e($request->input('inputExistencia'));
        $id_categoria=e($request->input('categoria'));
        $nuevo_subcategoria=e($request->input('subcategoria'));


        $categorias=Categoria::all();
        foreach ($categorias as $categoria) {
        	if($categoria->id==$id_categoria){
        		$nuevo_categoria=$categoria->nombre;
        	}
        }
        //dd($nuevo_categoria);

        $img = $request->file('file');
        $ruta;
        //codigo para imagen
        if (\File::exists($img)) {
            $ext=$img->getClientOriginalExtension();
            if (strtolower($ext) =='jpg'||strtolower($ext)=='jpeg'||strtolower($ext)=='bmp'||strtolower($ext)=='png') {
                $nombre="img_".$codigo.".".$ext;
                \Storage::disk('local')->put($nombre,  \File::get($img));
                $ruta=$nombre;
                //dd($ruta);
            }else{
                \Session::flash('mensaje','El formato no es valido. solo se permiten imagenes jpeg, jpg, png o bmp!!!');
                return \Redirect::back();
            }
                
        }else{
            //$user= User::find($id);
            $nombre=$producto->ruta;
            //$img=\Storage::disk('fotoUser')->get($nombre);
            $ruta=$nombre;
            //dd($ruta);
        }
        //fin codigo para imagen

        try
        {
            //$user= User::find($id);
            $producto->codigo  =  $producto->codigo;
            $producto->nombre  =  $nuevo_nombre;
            $producto->descripcion=$nuevo_descripcion;
            $producto->precio_compra=$nuevo_precioC;
            $producto->precio_venta=$nuevo_precioV;
            $producto->existencia=$nuevo_existencia;
            $producto->categoria=$nuevo_categoria;
            $producto->subcat=$nuevo_subcategoria;
            $producto->ruta=$ruta;
            $resul= $producto->save();
            //dd('hasta aqui va bien');

            if($resul){
                //$productos=Producto::all();
                //return view("users.listado2")->with('usuarios',$usuarios)->with('bandera',$bandera)->with('exception',$exception);
                \Session::flash('mensaje','Los datos del producto '.$codigo.' fueron modificados con exito!');
                return redirect('modificarProducto/'.$id);
                          
            }
            else
            {
                         
                return 'Ocurrio algún error vuelva a intentarlo por favor';  

            }
        }catch(\Exception $e){
            //$usuarios=User::all();
            \Session::flash('mensaje','Ocurrio un error verificar datos!!!');
            //return view("users.listado2")->with('usuarios',$usuarios)->with('exception',$exception)->with('bandera',$bandera);
            return redirect('modificarProducto/'.$id);
        }
	}


    //funcionando los siguientes dos metodos para el modulo entradas
    public function entrada(){
    	$productos=Producto::paginate(5);
    	$productos2=Producto::all();
		$categorias=Categoria::all();

		return view('productos.entrada')->with('productos',$productos)->with('categorias',$categorias)->with('productos2',$productos2);
    }

    //funcionando
    public function actualizar_productos(Request $request)
    {
    	$datos_json = ($request->input('datos2'));
		$datos=json_decode($datos_json, true);

		$codigos_json = ($request->input('codigos'));
		$codigos=json_decode($codigos_json, true);

		//dd($datos,$codigos);

        try
        {
        	for ($i=0; $i < count($codigos) ; $i++) { 
				$resul=DB::table('producto')
				->where('codigo', array_get($codigos[$i], 'codigo'))
				->update($datos[$i]);

			}
            

            if($resul){
                $productos=Producto::paginate(5);
                $categorias=Categoria::all();
                $productos2=Producto::all();
                \Session::flash('mensaje','Los productos fueron agregados con exito!');
                return redirect('/entradaProducto')->with('productos',$productos)->with('categorias',$categorias)->with('productos2',$productos2);
                          
            }
            else
            {
                         
                //return 'Ocurrio algún error vuelva a intentarlo por favor'; 
                \Session::flash('mensaje','Ocurrio un error, por favor verifica los datos y que el codigo de producto exista!!!');
           		return redirect('entradaProducto'); 

            }
        }catch(\Exception $e){
          \Session::flash('mensaje','Por favor verificar los datos, ocurrio un error!!!');
          return redirect('entradaProducto');
        }
        
    }

    public function listaEliminar(){
    	$productos=Producto::paginate(10);
        return view('productos.listadoEliminar')->with('productos',$productos);
    }

    public function eliminarProducto($id){
    	try {
            $producto=Producto::findOrFail($id);

            if ($producto->ruta=='none.jpg') {
                
            }else{
                //Storage::delete('file.jpg');
                \Storage::disk('local')->delete($producto->ruta);
            }

            $producto->delete();
            \Session::flash('mensaje','El producto '.$producto->nombre.' fue eliminado con exito!');
            $productos=Producto::all();

            return redirect('listadoEliminar');
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
