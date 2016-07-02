<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Comentario;

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
}
