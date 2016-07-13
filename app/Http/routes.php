<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        // Uses Auth Middleware
   });

*/
Route::get('usuario/enviarLink' , 'UsuarioController@enviarLinkRecuperarClave'); 

Route::group(['middleware' => 'auth'], function () {
	Route::post('usuario/validarDonacion' , 'UsuarioController@validarDonacion'); 
	Route::post('comentario/postearComentario', 'ComentarioController@storeComentario'); 
	Route::post('comentario/sotreRespuesta', 'ComentarioController@sotreRespuesta');
	Route::post('hospedaje/eliminarImagen/', 'HospedajeController@eliminarImagenHosp'); 
	Route::post('resenia/storeResenia', 'ReseniaController@storeResenia'); 
	Route::post('puntaje/puntuarUsuario', 'PuntajeUsuarioController@puntuarUsuario'); 


	Route::get('usuario/seguimiento/{id}', 'UsuarioController@getSeguimiento'); 
	Route::get('hospedaje/eliminarHospAdmin', 'HospedajeController@eliminarHospAdmin'); 
	Route::get('usuario/getViewDonacion', 'UsuarioController@getViewDonacion'); 
	Route::get('hospedaje/buscar', 'HospedajeController@buscarHospedaje'); 
	Route::get('hospedaje/comentarCouch/{id}', 'HospedajeController@comentarCouch'); 
	Route::get('reservas/crearId/{id}', 'ReservasController@createId');
	Route::get('reservas/confirmarReserva/{id_reserva}', 'ReservasController@confirmarReserva');
	Route::get('reservas/cancelarReserva/{id_reserva}', 'ReservasController@cancelarReserva');
	Route::get('reservas/couchRealizados', 'ReservasController@couchRealizados'); 
	Route::get('usuarios/getUsuarios', 'UsuarioController@getUsuarios'); 
	Route::get('hospedaje/actDesc/{id}/{activar}', 'HospedajeController@actDesc'); 
	Route::get('reserva/buscarCouchs', 'ReservasController@buscarCouchs'); 
	Route::get('usuario/filtrarUsuarios', 'UsuarioController@filtrarUsuarios'); 
	
	Route::get('hospedaje/verReservas/{id}', 'ReservasController@verReservas'); 
	Route::get('hospedajes/misHospedajes', 'HospedajeController@misHospedajes'); 
	Route::get('/',['as' => 'home', 'uses' => 'PagesController@home']);
	Route::get('donacion/getDonaciones', 'DonacionController@getDonaciones'); 
	Route::get('donacion/filtrarDonacion', 'DonacionController@filtrarDonaciones'); 
	//Routes resources
	Route::resource('TiposDeHospedaje', 'TiposDeHospedajeController');
	Route::resource('Usuario', 'UsuarioController'); 
	Route::resource('Hospedaje', 'HospedajeController'); 
	Route::resource('Donacion', 'DonacionController'); 
	Route::resource('Propiedad', 'PropiedadController');
	Route::resource('ImagenesHospedaje', 'ImagenesHospedajeController'); 
	Route::resource('Reservas', 'ReservasController'); 

}); 
Route::auth(); 

//Route::post('auth/register', 'Auth\AuthController@postRegister'); 

Route::get('/home', 'HomeController@index');

Route::controllers([
//  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

/*
Route::GET('Usuario/edit/{id}', 'UsuarioController@edit'); 
*/






// Authentication routes..
/*
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');




// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');

*/



//Route::get('auth/verPerfil', 'Auth\AuthController@verPerfil');






//Route::get('/verPerfil/{id}','PagesController@verPerfil'); 