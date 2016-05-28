<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposDeHospedaje extends Model
{
	protected $table = 'TiposDeHospedaje';
    
    protected $fillable = [
        'descripcion'
    ];

    
}
