<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
	protected $table = 'Propiedad';
    
    protected $fillable = [
        'calle', 
        'capacidad',
        'idCiudad',
        'idProvincia',
        'idTipoHospedaje', 
        'nro', 
        'idPropiedad'
    ];

}
