<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session; 
Use DB; 
//use App\User;
use Carbon\Carbon;
use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.home'); 
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
     * @param int  $id
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
        $usuario = Usuario::findOrFail($id);

        return view('auth.Perfil.verPerfil')->withUsuario($usuario);
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
        $usuario = Usuario::findOrFail($id);
 
        $this->validate($request, [
            'name' => 'required|regex:/[A-Za-z\s]/|max:255',
            'apellido' => 'required|regex:/[A-Za-z\s]/|max:255',
            'fechaNacimiento' => 'required|date_format:d/m/Y',
            'provincia' => 'required|regex:/[A-Za-z\s]/|max:255',
            'telefono' => 'numeric|digits_between:10,12'        
        ]);
        /*        $desde = Carbon::createFromFormat('H:i', $request->input('desde'));
        $input['desde'] = $desde;
*/
        $input = $request->all();
        $fechaN = Carbon::createFromFormat('d/m/Y', $request->input('fechaNacimiento'))->format('Y-m-d'); 

        $input['fechaNacimiento'] = $fechaN; 

        $usuario->fill($input)->save();
 
        Session::flash('flash_message', 'Perfil actualizado con exito!');

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
        //
    }

    /*Metodos declarados por el programador*/

    public function enviarLinkRecuperarClave(Request $request)
    {
        //$email = Input::get('email'); 
     
        $usuario = DB::table('users')
        ->select('id')
        ->where('email', '=' , $request->email)
        ->get(); 
        if($usuario){
            Session::flash('alert-info', 'Se envió el link de recuperación a la casilla: ' . $request->email);
        }
        else {
            Session::flash('alert-danger', 'Dirección de email inválida!');
        }

        return redirect()->back();

    }

    public function validarDonacion(Request $request)
    {
        if(($request->tipoTarj == 'VISA') and ($request->nroTarjeta == '1111') and ($request->codSeg == '222') and ($request->fechVenc == '01/17')/* and ($request->nomTitular == 'Batman')*/){
            $id = Auth::user()->id; 
            $result = DB::table('users')
            ->where('id',$id)
            ->update(['premium' => 1]); 
            if($result){
                Session::flash('alert-success', 'Donación realizada con éxito. Usted ya puede disfrutar de los beneficios de ser Usuario Premium'); 
            }
            else{
                Session::flash('alert-danger', 'Algo salio mal en la actualización!');    
            }
            


        }
        else {
            Session::flash('alert-danger', 'Datos invalidos o fondos insuficientes!');
        }
        return redirect()->back();
    }

    public function getViewDonacion()
    {
        //aca se debe retornar la vista para ingresar banco, nroTarjeta, monto de donacion. 
        return view('pages.Usuario.donacion');
       
    }
}
