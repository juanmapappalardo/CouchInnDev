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

    static function getCouchRealizados(){
    	$couchs = DB::table('reservas')
    				  ->join('hospedaje', 'hospedaje.id', '=','reservas.id_hospedaje')
    				  ->leftjoin('users as usuP', 'usuP.id', '=','hospedaje.idUsuarioPublic' )
    				  ->leftjoin('users as usuI','usuI.id','=', 'reservas.id_usuario')    				  
    				  ->where('reservas.fechaFin', '<', \Carbon\Carbon::now()->format('d-m-Y'))
    				  ->where('reservas.id_estado', '=', 3)
    				  ->select('hospedaje.titulo', 'usuP.name as nameP', 'usuI.name as nameI', 'reservas.fechaIni', 'reservas.fechaFin')
    				  ->get(); 
    	return $couchs; 
    }
}
