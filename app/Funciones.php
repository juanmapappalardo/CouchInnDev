<?php
namespace App;

use DB;
use Carbon\Carbon;
use Session; 


class Funciones
{
	public static function getProvinciasSelect(){
		$provincias=DB::table('provincia')->select('id', 'provincia_nombre')->orderBy('provincia_nombre')->get(); 
		$provincias_sel = array(); 

		foreach ($provincias as $prov) {
			$provincias_sel[$prov->id] = $prov->provincia_nombre; 
		}

		return $provincias_sel; 
	}

	public static function getCiudadesSelect(){
		$ciudades = DB::table('ciudad')->select('id_ciudad', 'ciudad_nombre')->orderBy('ciudad_nombre')->get(); 
		$ciudades_sel = array(); 

		foreach ($ciudades as $ciu){
			$ciudades_sel[$ciu->id_ciudad]=$ciu->ciudad_nombre; 
		}

		return $ciudades_sel; 
	}

	public static function getTiposHospedajesSelect(){
		$tiposHospedajes = DB::table('TiposDeHospedaje')->select('id', 'descripcion')->orderBy('descripcion')->get(); 
		$tiposHospedajes_sel = array(); 

		foreach ($tiposHospedajes as $tipHosp) {
			$tiposHospedajes_sel[$tipHosp->id] = $tipHosp->descripcion; 
		}

		return $tiposHospedajes_sel; 
	}

	public static function validarFechasBuscar($fechaIni, $fechaFin){
		$fIni = Carbon::createFromFormat('d/m/Y', $fechaIni); 
        $fFin = Carbon::createFromFormat('d/m/Y', $fechaFin); 
        $ok = true; 
        
        if($fIni->gt($fFin)){
            Session::flash('alert-danger', 'La fecha de inicio no puede ser mayor a la fecha de fin');
            $ok = false; 
        }
        if($fFin->gt(Carbon::now())){
            Session::flash('alert-danger', 'La fecha de fin no puede ser mayor al día de hoy. ('.Carbon::now()->format('d/m/Y').')');
            $ok = false; 
        }

        return $ok; 
	}
}
