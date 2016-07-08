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

    static function getPuntajeUsuario($id){
        $puntaje = DB::table('puntajes_usuario')
                       ->join('reservas', 'reservas.id_reserva', '=', 'puntajes_usuario.id_reserva')
                       ->leftjoin('hospedaje', 'hospedaje.id', '=', 'reservas.id_hospedaje')
                       ->select('puntajes_usuario.*','reservas.*', 'hospedaje.titulo')
                       ->where('puntajes_usuario.id_usuario', $id)
                       ->get(); 
        $totalPuntos = 0; 
        foreach ($puntaje as $punt) {
            $totalPuntos = $totalPuntos + $punt->puntaje; 
        }

        $puntaje['total_puntos'] = $totalPuntos; 

        return $puntaje; 
    }

}
