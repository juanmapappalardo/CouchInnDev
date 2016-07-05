<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;
class PuntajeUsuario extends Model
{
    protected $table = 'puntajes_usuario'; 

    protected $fillable = [    	
    	'id_reserva', 
    	'id_usuario_creador', 
    	'id_usuario', 
    	'puntaje'
    ];

    static function sinPuntaje($id_reserva){
    	$puntaje = DB::table('puntajes_usuario')->where('puntajes_usuario.id_reserva', $id_reserva)->get(); 
    	if(!$puntaje){
    		return 1;
    	}
    	else{
    		return 0; 
    	}
    	
    }

}
