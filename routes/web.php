<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$eventos = App\Event::get();
    return view('welcome', ['eventos'=>$eventos]);
})->name('inicio');
Route::get('/home', function () {
	$eventos = App\Event::get();
    return view('welcome', ['eventos'=>$eventos]);
})->name('inicio');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

//ROTAS USER
Route::resource('usuario','UserController');
Route::post('/usuario/muda_foto', 'UserController@mudaFoto')->name('usuario.muda_foto');
Route::get('/usuario/retira_foto/{id}', 'UserController@retiraFoto')->name('usuario.retira_foto');

//ROTAS BANDA
Route::resource('banda','BandController');
Route::post('/banda/delete/{id}', 'UserController@delete')->name('banda.delete');