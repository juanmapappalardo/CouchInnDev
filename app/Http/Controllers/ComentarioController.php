<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Comentario;
use App\Respuesta;

use Session; 

class ComentarioController extends Controller
{
	public function storeComentario(Request $request){
		//dd($request->all()); 
		$this->validate($request, [
            'comentario' => 'required'
        ]);
		/*'comentario', 
    	'id_respuesta', */
    	try{
		        $inputComent = array(); 
		        $inputComent['comentario'] = $request->input('comentario'); 
		        $inputComent['id_respuesta'] = -1; 
		        $inputComent['id_usuario'] = Auth::user()->id; 
		        $inputComent['id_hospedaje'] = $request->input('id_hospedaje'); 


		        Comentario::create($inputComent); 

		        Session::flash('alert-success', 'Comentario almacenado correctamente!'); 
            	//return redirect('hospedajes/misHospedajes');
            	return redirect()->back();

    		}
    	catch(Exception $e){
    		Session::flash('alert-danger', 'Algo salió mal el comentario no se pudo guardar!. Error:'.$e);
            return redirect()->back();

    	}
	}

	public function sotreRespuesta(Request $request){

		$this->validate($request, [
			'respuesta' => 'required'
		]);

		$inputResp = array(); 
		$inputResp['id_comentario'] = $request->input('id_comentario'); 
		$inputResp['respuesta'] = $request->input('respuesta'); 
		$inputResp['id_usuario'] = Auth::user()->id; 
		Respuesta::create($inputResp);		

		 
		$idResp = Respuesta::getMaxId(); 

		$dataComent = array(); 
		$dataComent['id_resp'] = $idResp; 
		$dataComent['id_coment'] = $request->input('id_comentario'); 

		Comentario::updateIdResp($dataComent); 
		
		Session::flash('alert-success', 'Respuesta guardada con éxito!');     	
    	return redirect()->back();


	}
}
