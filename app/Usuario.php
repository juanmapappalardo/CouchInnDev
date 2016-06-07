<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
