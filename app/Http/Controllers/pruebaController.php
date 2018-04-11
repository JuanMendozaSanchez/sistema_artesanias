<?php

namespace SistemaLaOax\Http\Controllers;

use Illuminate\Http\Request;
use SistemaLaOax\Prueba;
use DB;

class pruebaController extends Controller
{
    //
    public function arreglo(Request $request){
	$datos_json = ($request->input('datos'));
	$datos=json_decode($datos_json, true);

	$codigos_json = ($request->input('codigos'));
	$codigos=json_decode($codigos_json, true);
	//$array=json_decode($request->input('variable'));
	//Prueba::insert($dat); // Eloquent approach
	//dd($datos,$codigos);
	//dd(array_get($dat[0], 'nombre'));
	//return view('tablas.obtener_datos');
	//DB::table('prueba')->insert($dat);

	//$cod=array_get($codigos[0], 'nombre');
	//$user = DB::table('prueba')->where('nombre', $cod)->first();
	//dd($user);

	for ($i=0; $i < count($codigos) ; $i++) { 
		DB::table('prueba')->where('nombre', array_get($codigos[$i], 'nombre'))
		->update($datos[$i]);
	}

	//$itemTypes = [1, 2, 3];

	
	//DB::table('prueba')->whereIn('id', $itemTypes)->update();


	//funciona bien para actualizar
	//DB::table('prueba')->where('nombre', array_get($dat[0], 'nombre'))->update($dat[0]);

	




    }

    public function actualizar_usuario(Request $request)
    {
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
}
