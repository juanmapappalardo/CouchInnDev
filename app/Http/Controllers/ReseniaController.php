<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Resenia;
use Session; 

class ReseniaController extends Controller
{
    public function storeResenia(Request $request){
    	$this->validate($request, [
            'resenia' => 'required'
        ]);
    	$input = array();
    	$input = $request->all(); 

    	Resenia::create($input); 
   		Session::flash('alert-success', 'Comentario almacenado correctamente!'); 

        return redirect()->back();
    }
}
