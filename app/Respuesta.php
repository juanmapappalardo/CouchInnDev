<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use DB;
class Respuesta extends Model
{
	protected $table = 'respuestas_comentarios'; 

    protected $fillable = [
    	'respuesta',  
    	'id_usuario'
    ];

    static function getMaxId(){
    	//
    	return DB::table('respuestas_comentarios')->max('id'); 
    }
}
