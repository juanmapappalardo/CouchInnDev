<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TiposDeHospedaje; 

use App\Http\Requests;

use Session; 

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

        $input = $request->all();
        TiposDeHospedaje::create($input);

        Session::flash('flash_message', 'Tipo de Hospedaje agregado con éxito!');
        
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

        return redirect()->back();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $tipo = TiposDeHospedaje::findOrFail($id);

        $tipo->delete();

        Session::flash('flash_message', 'Tipo de hospedaje eliminado correctamente!');

        return redirect()->back();
        

    }
}
