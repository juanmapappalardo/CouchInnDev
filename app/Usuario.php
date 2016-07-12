<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
Use DB; 

class Usuario extends Model
{
 	protected $table = 'users';

 	protected $fillable = [
    	'name',
    	'apellido',
    	'fechaNacimiento',
    	'email', 
    	'password',
    	'premium', 
    	'fechaDeRegistro', 
    	'email2',
    	'pathImagen',
    	'nickName', 
        'provincia', 
        'telefono'
    ]; 

    static function getUsuariosTodos(){
        $usuarios = DB::table('users')                        
                        ->where('administrador', 0)
                        ->get(); 

        return $usuarios; 
    }

    static function getUsuario($id){
        $usuario = DB::table('users')->where('id', $id)->get(); 

        return $usuario; 
    }

    static function getUsuarios($fIni, $fFin){
        
        $usuarios = DB::table('users')                                    
                ->where('users.created_at', '>=', $fIni)                
                ->Where('users.created_at', '<=', $fFin)                
                ->where('administrador', 0)
                ->get(); 

        return $usuarios; 
    }

    static function updatePremium($id){
        return DB::table('users')
            ->where('id',$id)
            ->update(['premium' => 1]); 
    }
}
