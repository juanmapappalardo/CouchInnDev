<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session; 
use App\Http\Requests;
use App\PuntajeUsuario; 

class PuntajeUsuarioController extends Controller
{
    //

    public function puntuarUsuario(Request $request){
    	try{
    		$request['puntaje'] = $request->input('puntaje') + 1; 
    	    PuntajeUsuario::create($request->all());	
    	    Session::flash('alert-success', 'Puntaje almacenado con éxito!');
    	}
    	catch(Exception $e){
    		Session::flash('alert-danger', 'Algo salió mal!. Error:'.$e);
    	}
    	return redirect()->back(); 
    }
}
