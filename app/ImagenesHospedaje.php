<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenesHospedaje extends Model
{
    protected $table = 'imagenesHospedaje';

     protected $fillable = [
        'idHospedaje', 
        'pathFoto'
    ];
}
