<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
