<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    //
	public function index()
    {
        if (request()->has('empty')) {
            $users = [];
        } else {
            $users = [
                'Joel', 'Ellie', 'Tess', 'Tommy', 'Bill',
            ];
        }
        $title = 'Listado de usuarios';
        return view('users.index', compact('title', 'users'));
    }
    public function show($id)
    {
        return view('users.show', compact('id'));
    }
    
    //funcion para listar todos los usuarios existentes
    public function mostrar_usuarios(){
    	$usuarios=User::all();
    	return view('users.listadoUsers')->with('usuarios',$usuarios);
    }

    //funcion para crear usuarios nuevos
    public function create()
    {
    	$usuarios=User::all();
    	 $bandera=1;
        return view('users.crear')->with('usuarios',$usuarios)->with('bandera',$bandera);
    }

    public function agregar_nuevo_usuario(Request $request)
	{

        $usuario = e($request->input('inputNombre'));
	    $correo = e($request->input('inputCorreo'));
	    $pass = e($request->input('inputPass'));
	    $tipo = e($request->input('tipo'));

	    //creamos un array con las reglas que deben cumplir nuestro formulario
	     $rules = array(
	         'usuario' => 'required|min:2|max:190',
	         'correo' => 'required|email|min:6|max:100|unique:users',
	         'password' => 'required|min:6|max:100'
	     );

	     //personalizamos los mensajes de error para nuestro formualario
	     $messages = array(
		     'required' => 'El campo :attribute es obligatorio.',
		     'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
		     'email' => 'El campo :attribute debe ser un email válido.',
		     'max' => 'El campo :attribute no puede tener más de :max carácteres.',
		     'unique' => 'El email ingresado ya existe en la base de datos'
		 );


        $validacion = Validator::make($rules, $messages);
        if ($validacion->fails())
        {
			 $errores = $validacion->errors(); 
			 return new JsonResponse($errores, 422); 
	         /*return view("mensajes.msj_rechazado")->with("msj","Existen errores de validación")
			                                      ->with("errors",$errores);*/ 			          
        }



      	$user= new User;
		$user->name  =  $usuario;
		$user->email=$correo;
		$user->password=$pass;
		$user->tipo=$tipo;

		$resul= $user->save();

		if($resul){
            $usuarios=User::all();
            $bandera=1;
            return view("users.crear")->with('usuarios',$usuarios)->with('bandera',$bandera);   
		}
		else
		{
             
            return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

		}
	}

}
