<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
Use DB;

class Hospedaje extends Model
{
 	protected $table = 'hospedaje';

 	protected $fillable = [
    	'descripHosp',
    	'fechaFin',
    	'fechaInicio',
    	'idPropiedad', 
    	'idUsuarioPublic', 
    	'titulo',
        'activo'
    ];    

    static function getHospedaje($id){

    	$hospedajes = DB::table('hospedaje')
				        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
				        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
				        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
				        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
				        ->leftjoin('ciudad', 'Propiedad.idCiudad', '=', 'ciudad.id_ciudad')

				        ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp' , 'hospedaje.descripHosp','ciudad.ciudad_nombre', 'users.id as id_usuario', 'hospedaje.activo', 'hospedaje.idPropiedad', 'hospedaje.fechaInicio', 'hospedaje.fechaFin')
				        ->where('hospedaje.id', '=', $id)
				        ->get();
        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 
        }


		return $hospedajes;

    }

    static function getHospedajesUsuario($id){
        $hospedajes = DB::table('hospedaje')
                        ->join('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')    
                        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
                        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
                        ->select('hospedaje.*', 'Propiedad.capacidad', 'provincia.provincia_nombre', 'TiposDeHospedaje.descripcion')
                        ->where('hospedaje.idUsuarioPublic', $id)
                        ->get(); 
        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y');             
        }                        
        return $hospedajes; 
    }

    static function getHospedajesActivos(){
        $hospedajes = DB::table('hospedaje')
            ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
            ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
            ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
            ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')        
            ->where('hospedaje.activo', '=', 1)
            ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp', 'hospedaje.fechaInicio', 'hospedaje.fechaFin', 'hospedaje.activo', 'users.premium', 'hospedaje.idPropiedad')
            ->get();

        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 
        }

        return $hospedajes; 
    }

    static function getHospedajes(){
        $hospedajes = DB::table('hospedaje')
            ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
            ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
            ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
            ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')       
            ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp', 'hospedaje.fechaInicio', 'hospedaje.fechaFin', 'hospedaje.activo')
            ->get(); 
        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 
        }


        return $hospedajes; 
    }

    static function getMisHospedajes(){
        $hospedajes = DB::table('hospedaje')
            ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
            ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
            ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
            ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')       
            ->where('hospedaje.idUsuarioPublic', '=', Auth::user()->id)
            ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp', 'hospedaje.fechaInicio', 'hospedaje.fechaFin', 'hospedaje.activo')
            ->get();

        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 
        }


        return $hospedajes; 
    }

    static function updateActivo($idHospedaje, $oper){
        DB::table('hospedaje')
        ->where('id', $idHospedaje)
        ->update([
                'activo'    => $oper
        ]);
    }
}
