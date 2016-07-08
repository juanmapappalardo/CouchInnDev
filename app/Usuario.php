<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    static function getUsuarios(){
        $usuarios = DB::table('users')                        
                        ->where('administrador', 0)
                        ->get(); 

        return $usuarios; 
    }

    static function getUsuario($id){
        $usuario = DB::table('users')->where('id', $id)->get(); 

        return $usuario; 
    }
}
