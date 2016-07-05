<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Use DB;
use Carbon\Carbon;

class Resenia extends Model
{
    protected $table = 'resenia_hospedaje'; 

    protected $fillable = [    	
    	'id_reserva', 
    	'id_usu_creador', 
    	'resenia', 
    	'puntaje'
    ];

    static function getResenias($id){
    	$resenias = DB::table('resenia_hospedaje')
    					->join('reservas', 'reservas.id_reserva', '=', 'resenia_hospedaje.id_reserva')
    					->leftjoin('hospedaje', 'hospedaje.id', '=', 'reservas.id_hospedaje')
    					->leftjoin('users', 'users.id', '=', 'resenia_hospedaje.id_usu_creador')
    					->select('resenia_hospedaje.*', 'users.name')
    					->where('hospedaje.id', '=', $id)
    					->orderBy('resenia_hospedaje.created_at')
    					->get(); 
    	return $resenias; 
    }

}
