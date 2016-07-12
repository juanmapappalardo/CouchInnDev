<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;

class ImagenesHospedaje extends Model
{
    protected $table = 'imagenesHospedaje';

     protected $fillable = [
        'idHospedaje', 
        'pathFoto', 
        'idPropiedad'
    ];

    static function getImagenHospedaje($idHospedaje){
    	$imagen = DB::table('imagenesHospedaje')->where('imagenesHospedaje.idHospedaje', $idHospedaje)->get(); 
    	$path = ''; 
    	foreach ($imagen as $img) {
    		$path = $img->pathFoto; 	
    	}
    	
    	return $path; 
    }
}
