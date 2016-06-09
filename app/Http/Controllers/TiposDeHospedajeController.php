<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TiposDeHospedaje; 

use App\Http\Requests;

use Session; 

use App\Hospedaje;
Use DB;     

class TiposDeHospedajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposDeHospedaje = TiposDeHospedaje::all();
 
        return view('pages.TiposDeHospedaje.abmTipoHospedaje')->withTipos($tiposDeHospedaje);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.TiposDeHospedaje.create'); 
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
        //dd($request->all());
        $this->validate($request, [
            'descripcion' => 'required'

        ]);

        $th = DB::table('TiposDeHospedaje')
        ->select('id')
        ->where('descripcion', '=' , $request->descripcion)
        ->get(); 

        if(!$th){
            $input = $request->all();
            TiposDeHospedaje::create($input);
            Session::flash('alert-success', 'Tipo de Hospedaje agregado con éxito!');
        }
        else {
            Session::flash('alert-danger', 'Tipo de Hospedaje no creado!. Ya exíste un tipo de hospedaje con esa descripción');
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $tipo = TiposDeHospedaje::findOrFail($id);

        return view('pages.TiposDeHospedaje.show')->withTipo($tipo); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $tipo = TiposDeHospedaje::findOrFail($id);

        return view('pages.TiposDeHospedaje.edit')->withTipo($tipo);
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
        $tipo = TiposDeHospedaje::findOrFail($id);

        $this->validate($request, [
            'descripcion' => 'required'
        ]);
        $input = $request->all();
        $tipo->fill($input)->save();

        Session::flash('flash_message', 'Tipo de Hospedaje Actualizado!');

        return redirect()->back();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propiedad = DB::table('Propiedad')
        ->select('idPropiedad')
        ->where('idTipoHospedaje', '=' , $id)
        ->get(); 

        if(!$propiedad){
            $tipo = TiposDeHospedaje::findOrFail($id);
            $tipo->delete();
            Session::flash('alert-success', 'Tipo de hospedaje eliminado correctamente!');
        }
        else{
            Session::flash('alert-danger', 'Existen Propiedades con este tipo. Este Tipo de Hospedaje no se puede eliminar!');
        }

        return redirect()->back();
        

    }
}
