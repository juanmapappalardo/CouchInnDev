<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Session; 
use DB; 

class PropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propiedades = DB::table('Propiedad')
        ->join('ciudad','Propiedad.idCiudad', '=', 'ciudad.id')
        ->leftjoin('provincia', 'provincia.id', '=', 'Propiedad.idProvincia')
        ->leftjoin('TiposDeHospedaje', 'TiposDeHospedaje.id', '=', 'Propiedad.idTipoHospedaje')
        ->select('provincia.provincia_nombre', 'ciudad.ciudad_nombre', 'TiposDeHospedaje.descripcion', 'capacidad', 'calle')
        ->where('idUsuario', '=', Auth::user()->id)
        ->get(); 
        return view('pages.Propiedad.index', array('propiedades' => $propiedades)); 
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
        //
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
