<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;
use Carbon\Carbon;

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
                       ->select('puntajes_usuario.puntaje','reservas.*', 'hospedaje.titulo', 'puntajes_usuario.created_at as fechaPuntuacion')
                       ->where('puntajes_usuario.id_usuario', $id)
                       ->get(); 
        $totalPuntos = 0; 
        foreach ($puntaje as $punt) {
            $totalPuntos = $totalPuntos + $punt->puntaje; 
            $punt->fechaPuntuacion = Carbon::createFromFormat('Y-m-d H:i:s',$punt->fechaPuntuacion)->format('d/m/Y'); 
            $punt->fechaIni = Carbon::createFromFormat('Y-m-d', $punt->fechaIni)->format('d/m/Y'); 
            $punt->fechaFin = Carbon::createFromFormat('Y-m-d', $punt->fechaFin)->format('d/m/Y'); 

        }

//        $puntaje['total_puntos'] = $totalPuntos; 
        $result=array('puntajes' => $puntaje, 'total' => $totalPuntos); 

        return $result; 
    }

}
