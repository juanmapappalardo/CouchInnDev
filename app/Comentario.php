<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Use DB;
use App\Comentario;
use Carbon\Carbon;

class Comentario extends Model
{
	protected $table = 'comentarios'; 

    protected $fillable = [
    	'comentario', 
    	'id_respuesta', 
    	'id_usuario', 
    	'id_hospedaje'

    ];

    static function getComentarios($idHospedaje){
    	$comentarios = DB::table('comentarios')
    						->join('users', 'users.id', '=', 'comentarios.id_usuario')    					   	
    					   	->select('comentarios.*', 'users.name as nomUsuario')
    					   	->where('id_hospedaje', $idHospedaje)
                            ->orderBy('comentarios.created_at')
    					   	->get(); 

        foreach ($comentarios as $comentario) {

            $fechaCreacion = Carbon::createFromFormat('Y-m-d H:i:s', $comentario->created_at)->format('d/m/Y H:i'); 
            $comentario->created_at = $fechaCreacion; 
        }

    	return $comentarios;  
    }


}
