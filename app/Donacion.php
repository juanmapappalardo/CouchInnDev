<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
 	protected $table = 'donaciones';

 	protected $fillable = [
 		'id_usuario', 
 		'monto'
 	]; 

 	
}
