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

    static function getComentariosConRespuestas($idHospedaje){
        $comentarios = DB::table('comentarios')
                            ->join('users', 'users.id', '=', 'comentarios.id_usuario')                          
                            ->leftjoin('respuestas_comentarios', 'respuestas_comentarios.id', '=', 'comentarios.id_respuesta')
                            ->select('comentarios.*', 'users.name as nomUsuario','respuestas_comentarios.respuesta', 'respuestas_comentarios.created_at as create_resp')
                            ->where('id_hospedaje', $idHospedaje)
                            ->orderBy('comentarios.created_at')
                            ->get(); 
        $fechaRespCreate =''; 

        foreach ($comentarios as $comentario) {

            $fechaCreacion = Carbon::createFromFormat('Y-m-d H:i:s', $comentario->created_at)->format('d/m/Y H:i'); 
            if($comentario->create_resp){
                $fechaRespCreate= Carbon::createFromFormat('Y-m-d H:i:s', $comentario->create_resp)->format('d/m/Y H:i');  
            }
            $comentario->created_at = $fechaCreacion;
            $comentario->create_resp = $fechaRespCreate;  
        }

        return $comentarios;  
    }

    static function updateIdResp($dataComent){

        DB::table('comentarios as coment')
            ->where('coment.id', '=', $dataComent['id_coment'])
            ->update([
                    'coment.id_respuesta' => $dataComent['id_resp']
            ]); 

    }


}
