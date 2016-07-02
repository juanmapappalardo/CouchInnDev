<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;

class Hospedaje extends Model
{
 	protected $table = 'hospedaje';

 	protected $fillable = [
    	'descripHosp',
    	'fechaFin',
    	'fechaInicio',
    	'idPropiedad', 
    	'idUsuarioPublic', 
    	'titulo'
    ];    

    static function getHospedaje($id){

    	$hospedaje = DB::table('hospedaje')
				        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
				        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
				        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
				        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
				        ->leftjoin('ciudad', 'Propiedad.idCiudad', '=', 'ciudad.id_ciudad')

				        ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp' , 'hospedaje.descripHosp','ciudad.ciudad_nombre', 'users.id as id_usuario')
				        ->where('hospedaje.id', '=', $id)
				        ->get();

		return $hospedaje;

    }
}
