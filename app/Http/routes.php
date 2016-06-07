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
	Route::get('usuario/getViewDonacion', 'UsuarioController@getViewDonacion'); 
	Route::get('/',['as' => 'home', 'uses' => 'PagesController@home']);
	Route::resource('TiposDeHospedaje', 'TiposDeHospedajeController');
	Route::resource('Usuario', 'UsuarioController'); 
	Route::resource('Hospedaje', 'HospedajeController'); 
	Route::resource('Donacion', 'DonacionController'); 

}); 




Route::get('/home', 'HomeController@index');

Route::controllers([
//  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
Route::auth(); 
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
Route::post('auth/register', 'Auth\AuthController@postRegister'); 
*/



//Route::get('auth/verPerfil', 'Auth\AuthController@verPerfil');






//Route::get('/verPerfil/{id}','PagesController@verPerfil'); 