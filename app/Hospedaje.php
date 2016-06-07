<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
