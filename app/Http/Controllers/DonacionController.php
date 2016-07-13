<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Donacion;
use Carbon\Carbon;
use App\Funciones;

class DonacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getDonaciones(){
        
        $don = $this->getDonacionEntreFechas(\Carbon\Carbon::now()->subMonth(), \Carbon\Carbon::now()); 

        return view('pages.Donaciones.index', array('donaciones' => $don['donaciones'], 'filtros' => $don['filtros'], 'totalDonaciones' => $don['total']));
    }

    public function filtrarDonaciones(Request $request){
        if(Funciones::validarFechasBuscar($request->input('fIni'), $request->input('fFin'))){
            $don = $this->getDonacionEntreFechas(Carbon::createFromFormat('d/m/Y', $request->input('fIni')), Carbon::createFromFormat('d/m/Y',$request->input('fFin'))); 

            return view('pages.Donaciones.index', array('donaciones' => $don['donaciones'], 'filtros' => $don['filtros'], 'totalDonaciones' => $don['total']));
        }
        else {
            return redirect()->back(); 
        }
    }

    private function getDonacionEntreFechas($fechaInicio, $fechaFin){
        $fIniBus = Carbon::createFromFormat('d/m/Y H:i:s',$fechaInicio->format('d/m/Y').' 00:00:00')->format('Y-m-d H:i:s'); 
        $fFinBus = Carbon::createFromFormat('d/m/Y H:i:s',$fechaFin->format('d/m/Y').' 23:59:59')->format('Y-m-d H:i:s'); 
        

        $donaciones = Donacion::getDonaciones($fIniBus,$fFinBus); 
        $total = 0; 
        foreach ($donaciones as $donacion) {
            $donacion->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $donacion->created_at)->format('d/m/Y'); 
            $total = $total + $donacion->monto; 
        }

        $filtros = array(); 
        $filtros['fIni'] = Carbon::createFromFormat('Y-m-d H:i:s',$fIniBus)->format('d/m/Y'); 
        $filtros['fFin'] = Carbon::createFromFormat('Y-m-d H:i:s',$fFinBus)->format('d/m/Y');  

        return  array('donaciones' => $donaciones, 'filtros' => $filtros, 'total' => $total); 

    }
}
