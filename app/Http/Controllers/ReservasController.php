<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Funciones;
use App\Reserva;
use App\Hospedaje;
use App\PuntajeUsuario;

Use DB;
use Session; 
use Carbon\Carbon;


class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::getReservasUsuario(Auth::user()->id); 

        foreach ($reservas as  $reserva) {
            
            $reserva->concretada = $this->esConcretada($reserva); 
            $reserva->fechaIni = Carbon::createFromFormat('Y-m-d', $reserva->fechaIni)->format('d/m/Y'); 
            $reserva->fechaFin = Carbon::createFromFormat('Y-m-d', $reserva->fechaFin)->format('d/m/Y'); 
        }

        return view('pages.Reservas.index', array('reservas' => $reservas)); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Reservas.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        if($this->validarReserva($request)){
            $input = $request->all(); 
            $input['id_estado'] = 2; 
            $input['fechaIni'] = Carbon::createFromFormat('d/m/Y', $request->input('fechaIni'))->format('Y-m-d'); 
            $input['fechaFin']=  Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'))->format('Y-m-d'); 
            $input['id_usuario'] = Auth::user()->id; 

            Reserva::create($input); 
            Session::flash('alert-success', 'Reserva registrada con éxito!');
            return redirect()->back();  
        }
        else{

            //Session::flash('alert-danger', 'Algo salio mal!');
            return redirect()->back(); 
        }
        
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
        $res = Reserva::buscarReserva($id);
        $reserva = $res[0]; 

        $reserva->fechaIni = Carbon::createFromFormat('Y-m-d', $reserva->fechaIni)->format('d/m/Y'); 
        $reserva->fechaFin = Carbon::createFromFormat('Y-m-d', $reserva->fechaFin)->format('d/m/Y'); 
        return view('pages.Reservas.edit', array('reserva' => $reserva));
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
        
        if($this->validarReserva($request)){
            /*
            $input = $request->all(); 
            $input['id_estado'] = 2; 
            $input['fechaIni'] = Carbon::createFromFormat('d/m/Y', $request->input('fechaIni'))->format('Y-m-d'); 
            $input['fechaFin']=  Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'))->format('Y-m-d'); 
            $input['id_usuario'] = Auth::user()->id; 
            */
            $fechaIni = Carbon::createFromFormat('d/m/Y', $request->input('fechaIni'))->format('Y-m-d'); 
            $fechaFin = Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'))->format('Y-m-d'); 
            Reserva::updateReserva($id, $fechaIni, $fechaFin); 
            Session::flash('alert-success', 'Reserva registrada con éxito!');
            return redirect()->back();  
        }
        else{
            return redirect()->back(); 
        }

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

    public function createId($idHospedaje){
        $hospedaje =Hospedaje::findOrFail($idHospedaje);
        
        $fechaIni =  Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
        $fechaFin =  Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 


        return view('pages.Reservas.create', array('idHosp' => $idHospedaje, 'fechaIni' => $fechaIni, 'fechaFin' => $fechaFin)); 
    }

    private function validarReserva($request){

        $fechaIni = Carbon::createFromFormat('d/m/Y', $request->input('fechaIni'));//->format('Y-m-d'); 
        $fechaFin=  Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'));//->format('Y-m-d');         

        $fechasHosp = DB::table('hospedaje')->where('hospedaje.id', $request->input('id_hospedaje'))->get(); 
        $fechIniHosp=Carbon::createFromFormat('Y-m-d', $fechasHosp[0]->fechaInicio);//->format('Y-m-d');
        $fechFinHosp=Carbon::createFromFormat('Y-m-d', $fechasHosp[0]->fechaFin);//->format('Y-m-d'); 
       
        

        if($fechaIni->lt($fechaFin)){
            
            if (($fechaIni->gte($fechIniHosp)) && ($fechaFin->lte($fechFinHosp))){
                if(!$this->encontroRango($fechaIni,$fechaFin, $request->input('id_hospedaje'))){
                    return true;
                }
                else{
                    $fechasReservadas = $this->getFechasReservas($request->input('id_hospedaje')); 
                    $fechas =''; 
                    foreach ($fechasReservadas as $reserva) {
                        $fechas= $fechas."["; 
                        $fechas = $fechas.Carbon::createFromFormat('Y-m-d', $reserva->fechaIni)->format('d/m/Y'); 
                        $fechas = $fechas.' - '.Carbon::createFromFormat('Y-m-d', $reserva->fechaFin)->format('d/m/Y'); 
                        $fechas = $fechas."]"; 
                    }


                    Session::flash('alert-danger', "Las fechas seleccionadas se encuentran dentro del rango de fechas de otra reserva Aceptada!.");
                    Session::flash('alert-warning', "Fechas de reserva aceptadas:\r\n".$fechas);
                    return false;  
                } 
            }
            else{
                Session::flash('alert-danger', 'Las fechas deben estar dentro de la vigencia del Hospedaje!');
                return false;  
            }
        }
        else{
            Session::flash('alert-danger', 'La fecha de fin seleccionada debe ser mayor o igual que la fecha de inicio.'); 
        }
    }

    private function encontroRango($fechaIni, $fechaFin, $idHospedaje){
        $reservas = $this->getReservas($idHospedaje); 
        $reservas= $reservas->where('id_estado', '=', 3)->get();
        $encontro=false; 

        if($reservas){
            foreach ($reservas as $reserva){
                if(!$encontro){
                    $fechaIniRes = Carbon::createFromFormat('Y-m-d', $reserva->fechaIni);
                    $fechaFinRes = Carbon::createFromFormat('Y-m-d', $reserva->fechaFin);

                    $encontro = ($this->estaEntre($fechaIni,$fechaIniRes,$fechaFinRes) || ($this->estaEntre($fechaFin,$fechaIniRes,$fechaFinRes)));
                }
            }
            return $encontro; 
        }
        else {
            return false; 
        }        
    }

    private function estaEntre($fecha,$fechaIni,$fechaFin){
        return ($fecha->gte($fechaIni) && $fecha->lte($fechaFin)); 
    }
    
    public function verReservas($id){ //idHospedaje
        
        $reservas = DB::table('reservas')
                        ->join('users', 'reservas.id_usuario', '=', 'users.id')
                        ->leftjoin('estados_reservas', 'estados_reservas.id_estado', '=', 'reservas.id_estado')
                        ->leftjoin('hospedaje', 'hospedaje.id', '=','reservas.id_hospedaje')
                        ->leftjoin('puntajes_usuario', 'puntajes_usuario.id_reserva','=', 'reservas.id_reserva')
                        ->select('reservas.id_reserva', 'hospedaje.titulo', 'users.name','users.id as id_usu', 'reservas.fechaIni', 'reservas.fechaFin', 'estados_reservas.desc_estado', 'reservas.id_estado', 'puntajes_usuario.puntaje')
                        ->where('reservas.id_hospedaje', $id)
                        ->get();

        $titulo = DB::table('hospedaje')->select('titulo')->where('id', $id)->get(); 
        $titulo = $titulo[0]->titulo;   

        foreach ($reservas as  $reserva) {
            if(!$reserva->puntaje){
                $reserva->puntaje = 0;                 
            }

            $reserva->concretada = $this->esConcretada($reserva);             
            $reserva->puntuada = $this->esPuntuada($reserva->id_reserva);

            $reserva->fechaIni = Carbon::createFromFormat('Y-m-d', $reserva->fechaIni)->format('d/m/Y'); 
            $reserva->fechaFin = Carbon::createFromFormat('Y-m-d', $reserva->fechaFin)->format('d/m/Y');   
        }

        return view('pages.Reservas.indexReservaHospedaje', array('reservas' => $reservas, 'titHosp' => $titulo));                    
    }

    private function getReservas($idHosp){
        $reservas = DB::table('reservas')->where('id_hospedaje', $idHosp);

        return $reservas; 
    }

    public function confirmarReserva($id_reserva){
        try{
            DB::table('reservas')->where('id_reserva', $id_reserva)->update(['id_estado' => 3]); 

            Session::flash('alert-success', 'Reserva confirmada con éxito!');
        }
        catch(Exception $e){
            Session::flash('alert-danger', 'Algo salio mal, la reserva no fué confirmada! Error: '.$e);
        }
        return redirect()->back();  
    }


    public function cancelarReserva($id_reserva){
        try{
            DB::table('reservas')->where('id_reserva', $id_reserva)->update(['id_estado' => 1]); 

            Session::flash('alert-success', 'Reserva cancelada con éxito!');
        }
        catch(Exception $e){
            Session::flash('alert-danger', 'Algo salio mal, la reserva no fué cancelada! Error: '.$e);
        }
        return redirect()->back();  


    }

    public function getFechasReservas($idHospedaje){
        $reservasAceptadas = DB::table('reservas')->where('id_estado', '=', 3)->where('id_hospedaje', '=', $idHospedaje)->get(); 


        /*
        foreach ($reservasAceptadas as $reserva) {
            $fechas['fechaIni'] = $reserva->fechaIni; //Carbon::createFromFormat('Y-m-d', $reserva->fechaIni)->format('d/m/Y'); 
            $fechas['fechaFIn'] = $reserva->fechaFin; //Carbon::createFromFormat('Y-m-d', $reserva->fechaFin)->format('d/m/Y'); 
        }
        */

        return $reservasAceptadas; 
    }

    public function couchRealizados(){

        $couchs = Reserva::getCouchRealizados(\Carbon\Carbon::now()->subMonth()->format('Y-m-d'), \Carbon\Carbon::now()->format('Y-m-d')); 
        foreach ($couchs as $couch) {
            $couch->fechaIni = Carbon::createFromFormat('Y-m-d', $couch->fechaIni)->format('d/m/Y'); 
            $couch->fechaFin = Carbon::createFromFormat('Y-m-d', $couch->fechaFin)->format('d/m/Y'); 
        }
        return view('pages.Reservas.couchRealizados', array('couchs' => $couchs,'fechaIniFiltro' => \Carbon\Carbon::now()->subMonth()->format('d/m/Y') , 'fechaFinFiltro' => \Carbon\Carbon::now()->format('d/m/Y')));         
    }

    private function esConcretada($reserva){
        $fechaFin = Carbon::createFromFormat('Y-m-d', $reserva->fechaFin);
        if(($fechaFin->lte(\Carbon\Carbon::now())) && ($reserva->id_estado == 3)){
            return 1; 
        }
        else{
            return  0; 
        }
    }

    private function esPuntuada($id_reserva){
        if(PuntajeUsuario::sinPuntaje($id_reserva)){
            return 0; 
        }
        else{
            return 1; 
        }
    }

    public function buscarCouchs(Request $request){


        /*
            VALIDAR LAS FECHAS QUE LLEGAN EN EL REQUEST
            BUSCAR LOS COUCHS COMO EN GETCOUCHREALIZADOS
            DEVOLVER LA MISMA VISTA QUE ESTE METODO, MAS LOS FILTROS QUE ME LLEGARON EN EL REQUEST.
        */
        if(Funciones::validarFechasBuscar($request->input('fechaInicio'), $request->input('fechaFin'))){
            $fIni = Carbon::createFromFormat('d/m/Y', $request->input('fechaInicio'))->format('Y-m-d'); 
            $fFin = Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'))->format('Y-m-d'); 

            $couchs = Reserva::getCouchRealizados($fIni, $fFin); 

            return view('pages.Reservas.couchRealizados', array('couchs' => $couchs,'fechaIniFiltro' => $request->input('fechaInicio') , 'fechaFinFiltro' => $request->input('fechaFin')));         
        }
        else{
            return redirect()->back(); 
        }
    }
    /*
    private function validarFechasBuscarCouch($fechaIni, $fechaFin){
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
    */
}
