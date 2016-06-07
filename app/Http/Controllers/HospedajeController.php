<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hospedaje;
use Session; 
use DB; 
class HospedajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $hospedajes = DB::table('hospedaje')
        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.idProvincia')
        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
        
        ->select('titulo','hospedaje.id', 'capacidad', 'provincia.descripcion', 'name','TiposDeHospedaje.descripcion as descTipoHosp')
        ->get();
                
        return view('pages.Hospedaje.index', array('hospedajes' => $hospedajes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospedajes = DB::table('hospedaje')
        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.idProvincia')
        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
        ->leftjoin('Ciudad', 'Propiedad.idCiudad', '=', 'Ciudad.idCiudad')
        ->select('titulo','hospedaje.id', 'capacidad', 'provincia.descripcion', 'name','TiposDeHospedaje.descripcion as descTipoHosp' , 'hospedaje.descripHosp','Ciudad.descripcion as descCiudad')
        ->where('hospedaje.id', '=', $id)
        ->get();
        

        return view('pages.Hospedaje.show', array('hospedajes' => $hospedajes)); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
