<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;

class Donacion extends Model
{
 	protected $table = 'donaciones';

 	protected $fillable = [
 		'id_usuario', 
 		'monto'
 	]; 

 	
 	static function getDonaciones($fechaIni, $fechaFin){
 		$donaciones = DB::table('donaciones')
 						->leftjoin('users', 'users.id', '=', 'donaciones.id_usuario')
 						
 						->where('donaciones.created_at', '>=', $fechaIni)
 						->where('donaciones.created_at', '<=', $fechaFin)
 						->select('donaciones.created_at', 'donaciones.monto', 'users.name', 'users.apellido', 'users.email')
 						->orderby('donaciones.created_at')
 						->get(); 
 		return $donaciones; 
 	}
}
