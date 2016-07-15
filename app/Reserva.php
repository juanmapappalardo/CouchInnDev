<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;
use Carbon\Carbon;

class Reserva extends Model
{
    protected $table = 'reservas'; 

    protected $fillable = [
    	'fechaIni', 
    	'fechaFin', 
    	'id_estado', 
    	'id_hospedaje', 
    	'id_usuario'
    ];

    static function getCouchRealizados($fechaIni, $fechaFin){
    	$couchs = DB::table('reservas')
    				  ->join('hospedaje', 'hospedaje.id', '=','reservas.id_hospedaje')
    				  ->leftjoin('users as usuP', 'usuP.id', '=','hospedaje.idUsuarioPublic' )
    				  ->leftjoin('users as usuI','usuI.id','=', 'reservas.id_usuario')    				  
    				  ->where('reservas.fechaFin', '<', $fechaFin)
                      ->where('reservas.fechaFin','>',$fechaIni)
    				  ->where('reservas.id_estado', '=', 3)                      
    				  ->select('hospedaje.titulo', 'usuP.name as nameP', 'usuI.name as nameI', 'reservas.fechaIni', 'reservas.fechaFin')
                      ->orderby('reservas.fechaFin')
    				  ->get(); 
    	return $couchs; 
    }

    static function getReservasUsuario($idUsuario){
        $reserv = DB::table('reservas')
                        ->join('hospedaje', 'hospedaje.id', '=','reservas.id_hospedaje')
                        ->leftjoin('resenia_hospedaje', 'resenia_hospedaje.id_reserva','=','reservas.id_reserva')
                        ->leftjoin('estados_reservas', 'reservas.id_estado', '=', 'estados_reservas.id_estado')
                        ->select('hospedaje.id', 'hospedaje.titulo', 'reservas.fechaIni', 'reservas.fechaFin', 'estados_reservas.desc_estado', 'reservas.id_estado', 'reservas.id_hospedaje', 'resenia_hospedaje.id as id_resenia', 'reservas.id_reserva')
                        ->where('reservas.id_usuario', $idUsuario)
                        ->get(); 
        return $reserv; 
    }

    static function buscarReserva($id){
        $reservas = DB::table('reservas')->where('id_reserva', '=', $id)->get(); 

        return $reservas; 
    }

    static function updateReserva($id, $fechaIni, $fechaFin){
        DB::table('reservas')->where('reservas.id_reserva', '=', $id)->update(['fechaIni' => $fechaIni, 'fechaFin' => $fechaFin]); 
    }
}
