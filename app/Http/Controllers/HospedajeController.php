<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Funciones; 
use App\Hospedaje;
use App\Propiedad;
use App\ImagenesHospedaje;
use App\Comentario;
use App\Resenia;

use Session; 
use DB; 
use Carbon\Carbon;
class HospedajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $hospedajes = Hospedaje::getHospedajesActivos(); 
        $provincias = Funciones::getProvinciasSelect(); 
        $provincias['-1'] = '-- Todas --'; 

        $ciudades= Funciones::getCiudadesSelect(); 
        $ciudades['-1'] = '-- Todas --'; 

        $tipos = Funciones::getTiposHospedajesSelect(); 
        $tipos['-1'] = '-- Todas --'; 

        return view('pages.Hospedaje.index', array('hospedajes' => $hospedajes,'provincias' => $provincias, 'ciudades' =>$ciudades , 'tiposHosp' => $tipos,'idUsuario' => -1, 'eliminar_hosp' => 0));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Hospedaje.create', array('provincias' => Funciones::getProvinciasSelect(), 'ciudades' => Funciones::getCiudadesSelect(), 'tiposHosp' => Funciones::getTiposHospedajesSelect())); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         *Como en el modelo uso una propiedad para un hospedaje, opté por no tener el controlador de Propiedad, 
         *y darle de alta en este mismo controlador
        */
        $this->validate($request, [
            'titulo' => 'required|unique:hospedaje',
            'calle' => 'required', 
            'descripcion' =>'required',
            'fechaInicio' =>'required',
            'fechaFin'=>'required',

        ]);
/*        if(!validarFechas($request)){*/

        if($this->fechasIncorrectas($request)){
            Session::flash('alert-danger', 'La fecha de fin debe ser mayor a la fecha de inicio');    
            return redirect()->back();
        }
        $inputProp = $this->getInputPropiedad($request); //retorna el arreglo necesario para almacenarlo con el modelo Propiedad
        Propiedad::create($inputProp); 
        
        $inputHosp = $this->getInputHospedaje($request); //retorna el arreglo necesario para almacenarlo con el modelo Hospedaje

        $inputHosp['activo'] = 1; 
        Hospedaje::create($inputHosp); 
        $idHosp = DB::table('hospedaje')->max('id');
        $this->alamacenarImg($request,$idHosp); //gestiona el almacenamiento de imagenes en la carpeta public/imagenes, y en la base de datos 




        Session::flash('alert-success', 'Hospedaje dado de alta correctamente!');
        return redirect()->back();
        
        //dd($request->all()); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $hospedaje= Hospedaje::getHospedaje($id);
        $imgs = $this->getImagenesHosp($id); 
        $comentarios = Comentario::getComentariosConRespuestas($id); 
        $resenias = Resenia::getResenias($id); 

        return view('pages.Hospedaje.show', array('hospedajes' => $hospedaje, 'imagenes' =>$imgs, 'id_hospedaje' => $id, 'comentarios' => $comentarios, 'resenias' => $resenias)); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $hospedaje = DB::table('hospedaje')
                        ->join('Propiedad', 'hospedaje.idPropiedad', '=', 'Propiedad.idPropiedad')
                        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id')
                        ->select('hospedaje.id','hospedaje.descripHosp','hospedaje.fechaFin', 'hospedaje.fechaInicio', 'hospedaje.titulo', 'Propiedad.*', 'TiposDeHospedaje.descripcion as descTipoHosp')
                        ->where('hospedaje.id', $id)
                        ->get(); 

        $idPropiedad = $hospedaje[0]->idPropiedad; 
        $ciudad = $this->getCiudad($idPropiedad); 
        $provincia = $this->getProvincia($idPropiedad); 
        $imagenes = $this->getImagenesHosp($id); 
    
        $provincias = Funciones::getProvinciasSelect(); 
        $ciudades = Funciones::getCiudadesSelect(); 

        
        return view('pages.Hospedaje.edit', array(  'hospedaje' => $hospedaje,
                                                    'provincias'=>$provincias, 
                                                    'ciudades'=>$ciudades,
                                                    'provHosp'=>$provincia, 
                                                    'ciuHosp'=>$ciudad,
                                                    'imagenes'=>$imagenes,
                                                    'tiposHosp' => Funciones::getTiposHospedajesSelect(),
                                                    'sizeImgArray' => count($imagenes)
                                                    )); 
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
      
       try{
            
           $this->validate($request, [
                'titulo' => 'required',
                'calle' => 'required', 
                'descripcion' =>'required',
                'fechaInicio' =>'required',
                'fechaFin'=>'required',
                'id' => 'required',
                'id_ciudad'=> 'required',
                'idTipoHospedaje' => 'required',
            ]);
            
            if(!$this->validarTitulo($request->input('titulo'), $id)){
                Session::flash('alert-danger', 'Este titulo ya existe para otro Hospedaje!');    
                return redirect()->back();
            }
            DB::beginTransaction();
            //valido las fechas
            if($this->fechasIncorrectas($request)){
                Session::flash('alert-danger', 'La fecha de fin debe ser mayor a la fecha de inicio');    
                return redirect()->back();
            }    

            //obtengo el modelo


            $hospedaje = Hospedaje::findorFail($id); 
            $idProp = $hospedaje->idPropiedad; 
          

            //filtro de request los datos para los dos modelos
            $inputProp = $this->getInputPropiedad($request); //retorna el arreglo necesario para almacenarlo con el modelo Propiedad
            $inputProp['idPropiedad'] = $idProp; 
            $inputHospedaje = $this->getInputHospedaje($request); 

            //actualizo los modelos
            $hospedaje->fill($inputHospedaje)->save(); 
          
            $this->updatePropiedad($inputProp); 

            //elimino y cargo las imagenes de la actualizacion
            $this->eliminarImagenesSeleccionadas($request, $id); 
            
            $this->alamacenarImg($request, $id); //gestiona el almacenamiento de imagenes en la carpeta public/imagenes, y en la base de datos 

            DB::commit();
            Session::flash('alert-success', 'Hospedaje Actualizado correctamente!'); 
            return redirect('hospedajes/misHospedajes');
           

        }catch(Exception $e){
            DB::rollBack();
            Session::flash('alert-danger', 'Algo salió mal el hospedaje no se pudo actualizar!. Error:'.$e);
            return redirect()->back();
        }

 //       dd($request); 
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{

            if($this->validarReservas($id)){
                DB::beginTransaction();

                $idPropiedad = DB::table('hospedaje')->where('id', $id)->get(); 
                
                $hosp = Hospedaje::findOrFail($id);
                $hosp->delete();
                $this->eliminarImagenes($id); 
                $propiedad= DB::table('Propiedad')->where('idPropiedad', $idPropiedad[0]->idPropiedad)->delete();
                
                DB::commit();
                Session::flash('alert-success', 'Hospedaje eliminado correctamente!'); 
            }
            return redirect()->back();
        }

        catch(Exception $e){
            DB::rollBack();
            Session::flash('alert-danger', 'Algo salió mal no se puede eliminar el hospedaje!. Error:'.$e);
            return redirect()->back();
        }

    }

    private function getInputPropiedad(Request $request){
        //del request saca los datos necesarios para dar de alta una Propiedad
        $inputPropiedad = array(); 
        $inputPropiedad['calle']=$request->input('calle'); 
        $inputPropiedad['capacidad']= $request->input('capacidad'); 
        $inputPropiedad['idCiudad']= $request->input('id_ciudad'); 
        $inputPropiedad['idProvincia']= $request->input('id'); 
        $inputPropiedad['idTipoHospedaje']= $request->input('idTipoHospedaje'); 
        $inputPropiedad['nro']=$request->input('nro'); 
        

        return $inputPropiedad; 
    }

    private function getInputHospedaje(Request $request)
    {
        //del request saca los datos necesarios para dar de alta un Hospedaje
        //$maxColumnValue = $db->query('SELECT MAX(column) as max FROM table')->current()->max;
        $inputHospedaje = array(); 
        $inputHospedaje['titulo'] = $request->input('titulo'); 
        $inputHospedaje['descripHosp'] = $request->input('descripcion'); 
        $inputHospedaje['fechaInicio'] = Carbon::createFromFormat('d/m/Y', $request->input('fechaInicio'))->format('Y-m-d'); 
        $inputHospedaje['fechaFin']=    Carbon::createFromFormat('d/m/Y', $request->input('fechaFin'))->format('Y-m-d'); 
        $inputHospedaje['idUsuarioPublic']=Auth::user()->id; 
        
        $inputHospedaje['idPropiedad']=DB::table('Propiedad')->max('idPropiedad'); 


        return $inputHospedaje; 
    }

    private function alamacenarImg($request, $idHosp)
    {

        $img1 =  $request->file('img1'); 
        if($img1){
            $nombre = $img1->getClientOriginalName(); 
            \Storage::disk('couch')->put($nombre, \File::get($img1)); 
            $this->saveImg($idHosp,$nombre); 

        }

        $img2 =  $request->file('img2'); 
        if($img2){
            $nombre = $img2->getClientOriginalName(); 
            \Storage::disk('couch')->put($nombre, \File::get($img2)); 
            $this->saveImg($idHosp,$nombre); 
        }
        $img3 =  $request->file('img3'); 
        if($img3){
            $nombre = $img3->getClientOriginalName(); 
            \Storage::disk('couch')->put($nombre, \File::get($img3)); 
            $this->saveImg($idHosp,$nombre); 
        }
    }

    private function saveImg($idHosp, $path){
       $img = array(); 
       $img['idHospedaje'] = $idHosp; 
       $img['pathFoto'] = 'imagenes/couch/'.$path;

       ImagenesHospedaje::create($img); 

    }

    private function getImagenesHosp($id)
    {
        $imagenes = DB::table('imagenesHospedaje')->where('idHospedaje',$id)->get(); 

        return  $imagenes; 

    }

    private function eliminarImagenes($id)
    {
        DB::table('imagenesHospedaje')->where('idHospedaje', $id)->delete(); 
    }

    private function fechasIncorrectas($request){
        $fechaIni = Carbon::createFromFormat('d/m/Y', $request->input('fechaInicio')); 
        $fechaFin = Carbon::createFromFormat('d/m/Y', $request->input('fechaFin')); 

        return ($fechaIni->gt($fechaFin));     
    }
    private function getProvincia($idPropiedad){
        $propiedad = DB::table('Propiedad')->where('idPropiedad', $idPropiedad)->get(); 
        $prov = DB::table('provincia')->where('id', $propiedad[0]->idProvincia)->get(); 

        return $prov; 

    } 
    private function getCiudad($idPropiedad){
        $prop = DB::table('Propiedad')->where('idPropiedad', $idPropiedad)->get(); 
        $ciu = DB::table('ciudad')->where('id_ciudad', $prop[0]->idCiudad)->get(); 

        return $ciu; 
    }

    public function eliminarImagenHosp($idImg){
        DB::table('imagenesHospedaje')->where('id',$idImg)->delete(); 
        /*
        Session::flash('alert-success', 'Imagen Eliminada!');
        return redirect()->back();
        */
    }

    private function eliminarImagenesSeleccionadas($request, $id){
        
        if($request->has('deleteImg1')){
            $this->eliminarImagenHosp($request->input('deleteImg1')); 
        }
        if($request->has('deleteImg2')){
            $this->eliminarImagenHosp($request->input('deleteImg2'));
        }
        if($request->has('deleteImg3')){
            $this->eliminarImagenHosp($request->input('deleteImg3'));
        }
        
    }

    private function validarTitulo($titulo, $id){
        $hospRep = DB::table('hospedaje')->where('hospedaje.titulo', $titulo)->where('hospedaje.id', '<>', $id)->get(); 

        if(!$hospRep){
            return true;
        }
        else {
            return false; 
        }
    }

    public function buscarHospedaje(Request $request){

        $hospedajes = DB::table('hospedaje')
        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id') 
        ->leftjoin('ciudad', 'ciudad.id_ciudad', '=','Propiedad.idCiudad'); 
        if($request->input('id_provincia') != '-1'){
            $hospedajes=$hospedajes->where('provincia.id', '=', $request->input('id_provincia')); 
        }
        if($request->input('idTipoHosp') != '-1'){
            $hospedajes=$hospedajes->orWhere('TiposDeHospedaje.id', '=', $request->input('idTipoHosp')); 
        }
        if($request->input('id_ciudad') != '-1'){
            $hospedajes=$hospedajes->orWhere('ciudad.id_ciudad', '=', $request->input('id_ciudad')); 
        }
        if($request->input('titulo') != ''){
            $hospedajes=$hospedajes->orWhere('hospedaje.titulo', 'Like', '%'.$request->input('titulo').'%'); 
        }
        $hospedajes = $hospedajes
                    ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp')
                    ->get();

        $provincias = Funciones::getProvinciasSelect(); 
        $provincias['-1'] = '-- Todas --'; 

        $ciudades= Funciones::getCiudadesSelect(); 
        $ciudades['-1'] = '-- Todas --'; 

        $tipos = Funciones::getTiposHospedajesSelect(); 
        $tipos['-1'] = '-- Todas --'; 

        return view('pages.Hospedaje.index', array('hospedajes' => $hospedajes,'provincias' => $provincias, 'ciudades' =>$ciudades , 'tiposHosp' => $tipos, 'idUsuario' => -1, 'eliminar_hosp' => 0));
      
//        dd($request); 
    }

    public function misHospedajes(){
        $hospedajes = Hospedaje::getMisHospedajes(); 

        $provincias = Funciones::getProvinciasSelect(); 
        $provincias['-1'] = '-- Todas --'; 

        $ciudades= Funciones::getCiudadesSelect(); 
        $ciudades['-1'] = '-- Todas --'; 

        $tipos = Funciones::getTiposHospedajesSelect(); 
        $tipos['-1'] = '-- Todas --'; 

        return view('pages.Hospedaje.index', array('hospedajes' => $hospedajes,'provincias' => $provincias, 'ciudades' =>$ciudades , 'tiposHosp' => $tipos,'idUsuario' => Auth::user()->id, 'eliminar_hosp' => 0));

    }
    /*
    private function getHospedajes($misHosp){
        $hospedajes = DB::table('hospedaje')
        ->join('users', 'hospedaje.idUsuarioPublic', '=', 'users.id')
        ->leftjoin('Propiedad', 'hospedaje.idPropiedad','=', 'Propiedad.idPropiedad')
        ->leftjoin('provincia', 'Propiedad.idProvincia', '=', 'provincia.id')
        ->leftjoin('TiposDeHospedaje', 'Propiedad.idTipoHospedaje', '=', 'TiposDeHospedaje.id') ; 
        if($misHosp){
            $hospedajes = $hospedajes->where('hospedaje.idUsuarioPublic', '=', Auth::user()->id); 
        }

        
        $hospedajes = $hospedajes                    
                    ->select('titulo','hospedaje.id', 'capacidad', 'provincia.provincia_nombre', 'name','TiposDeHospedaje.descripcion as descTipoHosp', 'hospedaje.fechaInicio', 'hospedaje.fechaFin', 'hospedaje.activo')
                    ->get();

        foreach ($hospedajes as $hospedaje) {
            $hospedaje->fechaInicio = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaInicio)->format('d/m/Y'); 
            $hospedaje->fechaFin = Carbon::createFromFormat('Y-m-d', $hospedaje->fechaFin)->format('d/m/Y'); 
        }

        return $hospedajes; 
    }
    */
    private function validarReservas($id){
        $reservas = DB::table('reservas')->where('id_estado', '<>', 1)->where('id_hospedaje', '=', $id)->get(); 
        if(!$reservas){
            return true; 
        } 
        else{
            Session::flash('alert-danger', 'Este hospedaje tiene reservas pendientes o aceptadas. No se puede eliminar el hospedaje!');           
        }
    }

    private function updatePropiedad($inpPropiedad){

        DB::table('Propiedad')
            ->where('idPropiedad', $inpPropiedad['idPropiedad'])
            ->update([
                    'calle'             => $inpPropiedad['calle'], 
                    'capacidad'         => $inpPropiedad['capacidad'],
                    'idCiudad'          => $inpPropiedad['idCiudad'], 
                    'idProvincia'       => $inpPropiedad['idProvincia'], 
                    'idTipoHospedaje'   => $inpPropiedad['idTipoHospedaje'], 
                    'nro'               => $inpPropiedad['nro'],
            ]);
    }

    public function comentarCouch($idHospedaje){
        $hospedaje = Hospedaje::getHospedaje($idHospedaje);
        $imgs = $this->getImagenesHosp($idHospedaje); 
        $comentarios = Comentario::getComentarios($id); 
        return view('pages.Hospedaje.show', array('hospedajes' => $hospedaje, 'imagenes' =>$imgs,'id_hospedaje' => $idHospedaje, 'comentarios' => $comentarios)); 
    }

    public function eliminarHospAdmin(){
        $hospedajes = Hospedaje::getHospedajes(); 
        $provincias = Funciones::getProvinciasSelect(); 
        $provincias['-1'] = '-- Todas --'; 

        $ciudades= Funciones::getCiudadesSelect(); 
        $ciudades['-1'] = '-- Todas --'; 

        $tipos = Funciones::getTiposHospedajesSelect(); 
        $tipos['-1'] = '-- Todas --'; 

        return view('pages.Hospedaje.index', array('hospedajes' => $hospedajes,'provincias' => $provincias, 'ciudades' =>$ciudades , 'tiposHosp' => $tipos,'idUsuario' => -1, 'eliminar_hosp' => 1));
    }

    public function actDesc($idHosp, $activar){
        Hospedaje::updateActivo($idHosp, $activar); 

        if($activar == 1 ){                        
            Session::flash('alert-success', 'Hospedaje activado correctamente!');           
        }
        else{
            Session::flash('alert-danger', 'Hospedaje desactivando correctamente!');           
        }
        return redirect()->back(); 
    }
}
