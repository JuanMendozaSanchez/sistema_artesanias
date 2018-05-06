<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Categoria;
use Illuminate\Support\Facades\Input;

class CategoriaController extends Controller
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
    	$categorias=Categoria::orderBy('id','desc')->get();
    	return view('categorias.principal')->with('categorias',$categorias);
    }

    public function agregarCategoria(Request $request)
	{
        $nombre = e(Input::get('nombre'));
	    $descripcion = e(Input::get('desc'));

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'nombre' => 'unique:categoria|required|min:3|max:150',
	     );

	     //personalizamos los mensajes de error para nuestro formualario
	     $messages = array(
	     	'required'=>'es necesario el campo :atributte ',
		     'unique' => 'La categoría ingresada ya existe en la base de datos'

		 );


        $validacion = \Validator::make($rules, $messages);
        
        if ($validacion->fails())
        {
			 $errores = $validacion->errors(); 
			 return new JsonResponse($errores, 422); 
			 return \Redirect::back()->withInput()->withErrors($errores );		          
        }else{
			try {
				$categoria= new Categoria;
				$categoria->nombre  =  $nombre;
				$categoria->descripcion=$descripcion;

				$resul= $categoria->save();
                if($resul){
		            $categorias=Categoria::all();
		            
                    \Session::flash('mensaje','La categoría '.$nombre.' fue agregada con exito!');

                    return redirect('categorias')->with('categorias',$categorias);
		              
				}
				else
				{
		             
		            return 'Ocurrio algún error vuelva a intentarlo por favor';  

				}

            } catch (\Exception $e) {
                $categorias=Categoria::all();
                \Session::flash('mensaje','La categoría '.$nombre.' ya existe!!!');

                return redirect('categorias')->with('categorias',$categorias);

            }
			
        }

	}

	public function formEditar($id){
		//funcion para cargar los datos de cada usuario en la ficha
        $categoria=Categoria::find($id);
        $contador=count($categoria);

        
        if($contador>0){          
            return view("categorias.modificar")
                   ->with("categoria",$categoria);   
        }
        else
        {            
            return 'Algo salio mal';  
        }
	}

	public function realizarActualizacion(Request $request,$id){
		$nuevo_nombre=e($request->input('nombre'));
        $nuevo_descripcion=e($request->input('descripcion'));

        try
        {
            $categoria= Categoria::find($id);
            $categoria->nombre  =  $nuevo_nombre;
            $categoria->descripcion=$nuevo_descripcion;

            $resul= $categoria->save();

            if($resul){
                \Session::flash('mensaje','Los datos de la categoría '.$id.' fueron modificados con exito!');
                return redirect('modificarCategoria/'.$id);
                          
            }
            else
            {
                         
                return 'Ocurrio algún error vuelva a intentarlo por favor';  

            }
        }catch(\Exception $e){
            \Session::flash('mensaje','Nombre '.$nuevo_nombre.' ya existe por vafor verificalo!!!');
            return redirect('modificarCategoria/'.$id);
        }
	}


	public function eliminarCategoria($id){
        
        try {
            $categoria=Categoria::findOrFail($id);
            $categoria->delete();
            \Session::flash('mensaje','La categoría '.$categoria->nombre.' fue eliminada con exito!');
            $categorias=Categoria::orderBy('id','desc')->get();

            return redirect('categorias');
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
