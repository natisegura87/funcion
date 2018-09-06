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
Route::get('/respuestas', 'PuestoController@createR')->name('respuestas.create');
Route::post('/puestos/preguntas', 'PuestoController@preguntas')->name('puestos.preguntas');

Route::get('/puestos', 'PuestoController@index')->name('puestos.index');
Route::get('/puestos/crear', 'PuestoController@create')->name('puestos.create');
Route::post('/puestos/guardar', 'PuestoController@store')->name('puestos.store');
Route::post('/puesto/editar/{id}', 'PuestoController@update')->name('puestos.update');
Route::post('/puesto/preguntas', 'PuestoController@updatePreg')->name('puestos.updatePreg');
Route::get('/puesto/{id}', 'PuestoController@edit')->name('puestos.edit');
Route::delete('/puesto/eliminar/{id}', 'PuestoController@destroy')->name('puestos.destroy');
Route::get('/puestosget', 'PuestoController@getPuestos')->name('puestos.get');
Route::get('/puestoget', 'PuestoController@getPuesto')->name('puesto.get');
Route::get('/puestosgetDep', 'PuestoController@getPuestosDep')->name('puestosDep.get');

Route::get('users', function () {
    return App\Empleado::all();
});

Route::get('/organigrama2', 'OrganigramaController@indexN')->name('organigrama.indexN');
Route::post('organigrama/ver', 'OrganigramaController@show')->name('organigrama.show');
Route::get('organigrama/get', 'OrganigramaController@getDep')->name('organigrama.get');
Route::get('organigrama/getP', 'OrganigramaController@getPue')->name('organigrama.getP');
Route::get('organigrama/crearPuestos', 'OrganigramaController@crearPuestos')->name('organigrama.crearPuestos');
Route::post('organigrama/verPuesto', 'OrganigramaController@showP')->name('organigrama.showP');
Route::post('organigrama/verNomenclador', 'OrganigramaController@showNomenclador')->name('organigrama.showNomenclador');
Route::get('/organigramaVer', 'OrganigramaController@index2')->name('organigrama.ver');

Route::get('/preguntas', 'PreguntaController@index')->name('preguntas.index');
Route::get('/preguntas/crear', 'PreguntaController@create')->name('preguntas.create');
Route::post('/preguntas/guardar', 'PreguntaController@store')->name('preguntas.store');
Route::post('/pregunta/editar/{id}', 'PreguntaController@update')->name('preguntas.update');
Route::get('/pregunta/{id}', 'PreguntaController@edit')->name('preguntas.edit');
Route::delete('/pregunta/eliminar/{id}', 'PreguntaController@destroy')->name('preguntas.destroy');
Route::get('pregunta/ver/{id}', 'PreguntaController@show')->name('preguntas.show');

//Route::resource('pregunta', 'PreguntaController');

Route::get('/nomenclador', 'NomencladorController@index')->name('nomenclador.index');
Route::get('/nomenclador/crear', 'NomencladorController@create')->name('nomenclador.create');
Route::post('/nomenclador/guardar', 'NomencladorController@store')->name('nomenclador.store');
Route::post('/nomenclador/editar/{id}', 'NomencladorController@update')->name('nomenclador.update');
Route::post('/nomenclador/preguntas', 'NomencladorController@updatePreg')->name('nomenclador.updatePreg');
Route::get('/nomenclador/{id}', 'NomencladorController@edit')->name('nomenclador.edit');
Route::delete('/nomenclador/eliminar/{id}', 'NomencladorController@destroy')->name('nomenclador.destroy');

Route::get('/nomencladorget', 'NomencladorController@nivelPreg')->name('nomenclador.getnivel');
Route::get('/nomencladorgetagrup', 'NomencladorController@getAgrupamientos')->name('nomenclador.getagrup');

Route::get('/organigramaPuestos', 'VincularpuestoController@index')->name('vincularpuesto.index');
Route::get('/vincularpuesto/crear', 'VincularpuestoController@create')->name('vincularpuesto.create');
Route::post('/vincularpuesto/guardar', 'VincularpuestoController@store')->name('vincularpuesto.store');
Route::post('/vincularpuesto/editar/{id}', 'VincularpuestoController@update')->name('vincularpuesto.update');
Route::get('/vincularpuesto/{id}', 'VincularpuestoController@edit')->name('vincularpuesto.edit');
Route::delete('/vincularpuesto/eliminar/{id}', 'VincularpuestoController@destroy')->name('vincularpuesto.destroy');
Route::get('/puestosgetunidad', 'VincularpuestoController@getUnidad')->name('vincularpuesto.get');
Route::get('/puestosgetP', 'VincularpuestoController@getPuestos')->name('vincularpuesto.getP');
Route::get('/puestosgetD', 'VincularpuestoController@getPuestoDep')->name('vincularpuesto.getD');

Route::get('/nomencladorfuncionarios', 'NomencladorController@indexF')->name('nomencladorfuncionarios.index');
Route::get('/nomencladorfuncionarios/crear', 'NomencladorController@createF')->name('nomenclador.create');
Route::post('/nomencladorfuncionarios/guardar', 'NomencladorController@storeF')->name('nomencladorfuncionarios.store');
Route::post('/nomencladorfuncionarios/editar/{id}', 'NomencladorController@updateF')->name('nomencladorfuncionarios.update');

Route::get('/nomencladorfuncionarios/{id}', 'NomencladorController@editF')->name('nomencladorfuncionarios.edit');

