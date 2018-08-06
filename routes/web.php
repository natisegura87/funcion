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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/preguntas', 'UnidadController@index')->name('preguntas');
Route::get('/crear', 'UnidadController@create')->name('crear');

Route::get('/puestos', 'PuestoController@index')->name('puestos');

Route::get('users', function () {
    return App\Empleado::all();
});

Route::get('/organigrama', 'OrganigramaController@index')->name('organigrama');
Route::get('organigrama/{id}', 'OrganigramaController@getNivel')->name('organigrama.getNivel');

Route::get('/preguntas', 'PreguntaController@index')->name('preguntas');
Route::get('/preguntas/crear', 'PreguntaController@create')->name('preguntas.create');
Route::post('/preguntas/guardar', 'PreguntaController@store')->name('preguntas.store');
Route::put('/pregunta/editar/{id}', 'PreguntaController@update')->name('preguntas.update');
Route::get('/pregunta/{id}', 'PreguntaController@edit')->name('preguntas.edit');
Route::delete('/pregunta/{id}', 'PreguntaController@destroy')->name('preguntas.destroy');
Route::get('pregunta/ver/{id}', 'PreguntaController@show')->name('preguntas.show');



