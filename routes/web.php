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

//ROTAS PESQUISA
Route::post('pesquisa', 'PesquisaController@pesquisa')->name('pesquisa');

//ROTAS USER
Route::resource('usuario','UserController');
Route::post('/usuario/muda_foto', 'UserController@mudaFoto')->name('usuario.muda_foto');
Route::get('/usuario/retira_foto/{id}', 'UserController@retiraFoto')->name('usuario.retira_foto');

//ROTAS BANDA
Route::resource('banda','BandController');
Route::get('/banda/painel_de_controle/{id}', 'BandController@control_panel')->name('banda.painel');
Route::get('/banda/delete/{id}', 'BandController@delete')->name('banda.delete');
Route::get('/banda/pagina/{id}', 'BandController@page')->name('banda.pagina');

Route::post('/banda/muda_foto/{id}', 'BandController@mudaFoto')->name('banda.muda_foto');
Route::get('/banda/retira_foto/{id}', 'BandController@retiraFoto')->name('banda.retira_foto');


Route::put('/banda/bio/{id}', 'BandController@mudaBio')->name('banda.muda_bio');

Route::get('/banda/{id}/integrante/{idInteg}', 'BandController@verIntegrante')->name('banda.integrante');

//ROTAS POST
Route::post('/post/store/{id}', 'PostController@store')->name('post.store');
Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
Route::get('/post/delete/{id}/banda/{idband}', 'PostController@delete')->name('post.delete');
Route::delete('/post/destroy/{id}/banda/{idband}', 'PostController@destroy')->name('post.destroy');
Route::get('/post/edit/{id}/banda/{idband}', 'PostController@edit')->name('post.edit');
Route::put('/post/update/{id}/banda/{idband}', 'PostController@update')->name('post.update');

//ROTAS SOCIAL MEDIA
Route::post('/social_media/store/{id}', 'Social_MediaController@store')->name('social_media.store');
Route::get('/social_media/edit/{id}/banda/{idband}', 'Social_MediaController@edit')->name('social_media.edit');
Route::put('/social_media/update/{id}/banda/{idband}', 'Social_MediaController@update')->name('social_media.update');
Route::get('/social_media/delete/{id}/banda/{idband}', 'Social_MediaController@delete')->name('social_media.delete');
Route::delete('/social_media/destroy/{id}/banda/{idband}', 'Social_MediaController@destroy')->name('social_media.destroy');

//ROTAS MEDIA
Route::post('/media/store/{id}', 'MediaController@store')->name('media.store');
Route::get('/media/edit/{id}/banda/{idband}', 'MediaController@edit')->name('media.edit');
Route::put('/media/update/{id}/banda/{idband}', 'MediaController@update')->name('media.update');
Route::get('/media/delete/{id}/banda/{idband}', 'MediaController@delete')->name('media.delete');
Route::delete('/media/destroy/{id}/banda/{idband}', 'MediaController@destroy')->name('media.destroy');

//ROTAS INTEGRANTE
Route::post('/integrante/store/{id}', 'IntegranteController@store')->name('integrante.store');
Route::get('/integrante/edit/{id}/banda/{idband}', 'IntegranteController@edit')->name('integrante.edit');
Route::put('/integrante/update/{id}/banda/{idband}/funcoes/{idinter}', 'IntegranteController@update')->name('integrante.update');
Route::get('/integrante/delete/{id}/banda/{idband}', 'IntegranteController@delete')->name('integrante.delete');
Route::delete('/integrante/destroy/{id}/banda/{idband}', 'IntegranteController@remove')->name('integrante.remove');