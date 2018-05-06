<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Subcategoria;
use SistemaLaOax\Categoria;
use Illuminate\Support\Facades\Input;
use DB;

class SubcategoriaController extends Controller
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
    
    public function inicio(){
    	$categorias=Categoria::all();
    	$subcategoria=Subcategoria::orderBy('sub_id','desc')->get();
    	return view('subcategorias.principal')->with('subcategorias',$subcategoria)
    	->with('categorias',$categorias);
    }

    public function agregarSubcategoria(Request $request)
	{
		$id = e(Input::get('categoria'));
        $nombre = e(Input::get('nombre'));
	    $descripcion = e(Input::get('desc'));

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'nombre' => 'unique:subcat|required|min:3|max:150',
	     );

	     //personalizamos los mensajes de error para nuestro formualario
	     $messages = array(
	     	'required'=>'es necesario el campo :atributte ',
		     'unique' => 'La subcategoría ingresada ya existe en la base de datos'

		 );


        $validacion = \Validator::make($rules, $messages);
        
        if ($validacion->fails())
        {
			 $errores = $validacion->errors(); 
			 return new JsonResponse($errores, 422); 
			 return \Redirect::back()->withInput()->withErrors($errores );		          
        }else{
			try {
				$subcategoria= new Subcategoria;
				$subcategoria->sub_id = $id;
				$subcategoria->nombre  =  $nombre;
				$subcategoria->descripcion=$descripcion;

				$resul= $subcategoria->save();
                if($resul){
		            $subcategorias=Subcategoria::all();
		            
                    \Session::flash('mensaje','La Subcategoría '.$nombre.' fue agregada con exito!');

                    return redirect('subcategorias')->with('subcategorias',$subcategorias);
		              
				}
				else
				{
		             
		            return 'Ocurrio algún error vuelva a intentarlo por favor';  

				}

            } catch (\Exception $e) {
                $subcategorias=Subcategoria::all();
                \Session::flash('mensaje','La subcategoría '.$nombre.' ya existe!!!');

                return redirect('subcategorias')->with('subcategorias',$subcategorias);

            }
			
        }

	}

	public function eliminarSubcategoria($nombre){
        try {
			DB::table('subcat')->where('nombre', '=', $nombre)->delete();
            \Session::flash('mensaje','La Subcategoría '.$nombre.' fue eliminada con exito!');

            $subcategorias=Subcategoria::orderBy('sub_id','desc')->get();
            return redirect('subcategorias');
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
