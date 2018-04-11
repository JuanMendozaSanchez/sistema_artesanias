<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\User;
use SistemaLaOax\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
//use \Validator;
use DB;

class UserController extends Controller 
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
    
    //funcion para listar todos los usuarios existentes
    public function mostrar_usuarios(){
        $busqueda=0;
    	$usuarios=User::orderBy('id','asc')->paginate(5);
    	return view('users.listadoUsers')->with('usuarios',$usuarios)->with('busqueda',$busqueda);
    }

    //funciones para insertar un nuevo usuario 
    public function create()
    {
    	$usuarios=User::paginate(5);
    	//$usuarios=User::orderBy('name','desc')->paginate(5);

        return view('users.crear')->with('usuarios',$usuarios);
    }

    public function agregar_nuevo_usuario(Request $request)
	{

        $usuario = e(Input::get('inputNombre'));
	    $correo = e(Input::get('inputCorreo'));
	    $pass = e(Input::get('inputPass'));
	    $tipo = e(Input::get('tipo'));

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'correo' => 'unique:users|required|email|min:6|max:100',
	     );

	     //personalizamos los mensajes de error para nuestro formualario
	     $messages = array(
	     	'required'=>'es necesario el campo :atributte ',
		     'unique' => 'El email ingresado ya existe en la base de datos'

		 );


        $validacion = \Validator::make($rules, $messages);
        
        if ($validacion->fails())
        {
			 $errores = $validacion->errors(); 
			 return new JsonResponse($errores, 422); 
	         /*return view("mensajes.msj_rechazado")->with("msj","Existen errores de validación")
			                                      ->with("errors",$errores);*/ 
			 //$usuarios=User::all();
			 return \Redirect::back()->withInput()->withErrors($errores );		          
        }else{
			try {
				$user= new User;
				$user->name  =  $usuario;
				$user->email=$correo;
				$user->password=bcrypt($pass);
				$user->tipo=$tipo;
				$resul= $user->save();
                if($resul){
		            $usuarios=User::all();
		            
                    \Session::flash('mensaje','El usuario '.$usuario.' fue agregado con exito!');
                    //$usuarios=User::all();

                    return redirect('formulario_usuario')->with('usuarios',$usuarios);
		              
				}
				else
				{
		             
		            return 'Ocurrio algún error vuelva a intentarlo por favor';  

				}

            } catch (\Exception $e) {
                $usuarios=User::all();
                \Session::flash('mensaje','El correo '.$correo.' ya existe!!!');
                //return view("users.crear")->with('usuarios',$usuarios)->with('exception',$exception)->with('bandera',$bandera);
                return redirect('formulario_usuario')->with('usuarios',$usuarios);

            }
			
        }

	}

    //funciones para llevar a cabo una actualizacion en los usuarios
    public function listado_usuarios2(){
        $usuarios=User::paginate(5);
        return view('users.listado2')->with('usuarios',$usuarios);
    }

    public function form_editar($id)
    {
        //funcion para cargar los datos de cada usuario en la ficha
        $usuario=User::find($id);
        $contador=count($usuario);

        
        if($contador>0){  
            $tipo=$usuario->tipo;        
            return view("users.modificar")
                   ->with("usuario",$usuario);   
        }
        else
        {            
            return 'Algo salio mal';  
        }
    }

    public function actualizar_usuario(Request $request,$id)
    {
        $nuevo_nombre=e($request->input('inputNombre'));
        $nuevo_correo=e($request->input('inputCorreo'));
        $nuevo_tipo=e($request->input('tipo'));

        try
        {
            $user= User::find($id);
            $user->name  =  $nuevo_nombre;
            $user->email=$nuevo_correo;
            $user->tipo=$nuevo_tipo;
            $resul= $user->save();

            if($resul){
                $usuarios=User::all();
                //return view("users.listado2")->with('usuarios',$usuarios)->with('bandera',$bandera)->with('exception',$exception);
                \Session::flash('mensaje','Los datos del usuario '.$id.' fueron modificados con exito!');
                return redirect('nueva_ruta/'.$id)->with('usuarios',$usuarios);
                          
            }
            else
            {
                         
                return 'Ocurrio algún error vuelva a intentarlo por favor';  

            }
        }catch(\Exception $e){
            //$usuarios=User::all();
            \Session::flash('mensaje','Correo '.$nuevo_correo.' existente por vafor verificalo!!!');
            //return view("users.listado2")->with('usuarios',$usuarios)->with('exception',$exception)->with('bandera',$bandera);
            return redirect('nueva_ruta/'.$id);
        }
        
    }

    //funciones para eliminar un usario 

    public function cargar_listado3(){
        $usuarios=User::paginate(5);
        return view('users.listado3')->with('usuarios',$usuarios);
    }

    public function eliminar_user($id){
        
        try {
            $usuario=User::findOrFail($id);
            $usuario->delete();
            \Session::flash('mensaje','El usuario '.$usuario->name.' fue eliminado con exito!');
            $usuarios=User::all();

            return redirect('datos_usuarios2');
        } catch (\Exception $e) {
            abort(404);
        }
    }


    public function buscar(Request $request){
        //$usuarios=User::paginate(5);
        $busqueda=1;
        $usuarios = DB::table('users')->where('name', 'like', '%'.$request->get('nombre').'%')->orderBy('id','DESC')->get();
        //$usuarios=User::name($request->get('nombre'));
        return view('users.listadoUsers')->with('usuarios',$usuarios)->with('busqueda',$busqueda);
    }

}
