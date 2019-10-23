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

/*
 * INICIO
 * */

Route::get('/', function () {
    return redirect()->route('login');
});

/*
 *  FUNCIONES COMUNES
 * */

Route::get('razas/{id}', 'FuncionesComunesController@obtenerRazas');

/*
 * PERFIL BLOQUEADO
 * */
Route::get('/perfilBloqueado', 'PerfilBloquedoController@index')->name('perfilBloqueado');

/*
 *  ACCESO NO AUTORIZADO
 * */

Route::get('/accesoNoAutorizado', 'NoAutorizadoController@index')->name('noAutorizado');

/*
 *  AUTENTICACION DE USUARIOS
 * */
Auth::routes(['confirm' => false]);
Route::get('/home', 'HomeController@index')->name('home');

/*
 *  ADMINISTRACION
 * */

Route::group(['prefix'=>'administracion', 'namespace'=>'Administrador', 'middleware'=> ['auth','admin'] ], function (){
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('empleados', 'EmpleadosController@index')->name('admin.empleados');
    Route::put('bloquear/{cod_usuario}', 'EmpleadosController@bloquearEmpleado')->name('admin.bloquear');

    Route::get('roles', 'RolController@index')->name('admin.roles');
    Route::put('bloquearRol/{cod_tipo_usuario}', 'RolController@bloquearRol')->name('admin.bloquearRol');

    Route::get('agregar', 'EmpleadosController@create')->name('admin.agregar');
    Route::post('agregar', 'EmpleadosController@store')->name('admin.gagregar');
});

/*
 * PELUQUERIA
 * */
Route::group(['prefix'=>'peluqueria', 'namespace' =>'Peluqueria','middleware'=>['auth','peluqueria']],function (){
    Route::get('dashboard', 'DashboardController@index')->name('peluqueria.dashboard');
    Route::get('atender', 'PeluqueriaController@index')->name('peluqueria.atender');
    Route::get('atenderMascota/{cod_expediente}/{cod_peluqueria}', 'PeluqueriaController@create')->name('peluqueria.atenderMascota');
    Route::put('atenderMascota/{cod_peluqueria}', 'PeluqueriaController@update')->name('peluqueria.gservicio');
});

/*
 * SECRETARIA
 * */
Route::group(['prefix'=>'secretaria', 'namespace' =>'Secretaria', 'middleware'=>['auth','secretaria']],function (){
    Route::get('dashboard', 'DashboardController@index')->name('secretaria.dashboard');
    Route::get('agregar','MascotasController@create')->name('secretaria.crear');
    Route::post('agregar','MascotasController@store')->name('secretaria.gmascota');
    Route::get('consulta', 'ConsultaController@index')->name('secretaria.consulta');
    Route::get('busqueda/{metodo}/{busqueda}', 'ConsultaController@show')->name('secretaria.busqueda');

    Route::get('nuevaConsulta/{cod_expediente?}', 'ConsultaController@createConsulta')->name('secretaria.nuevaConsulta');
    Route::post('nuevaConsulta','ConsultaController@storeConsulta')->name('secretaria.gconsulta');

    Route::get('nuevaVacuna/{cod_expediente?}', 'ControlVacunasController@create')->name('secretaria.nuevaVacuna');
    Route::post('nuevaVacuna','ControlVacunasController@store')->name('secretaria.gvacuna');

    Route::get('nuevaPeluqueria/{cod_expediente?}', 'PeluqueriaController@create')->name('secretaria.nuevaPeluqueria');
    Route::post('nuevaPeluqueria','PeluqueriaController@store')->name('secretaria.gpeluqueria');

    Route::get('actualizar', 'MascotasController@fmostrar')->name('secretaria.actualizar');
    Route::get('asignar/{cod_propietario?}', 'MascotasController@factualizar')->name('secretaria.asignar');
    Route::post('actualizar/{cod_propietario}', 'MascotasController@actualizar')->name('secretaria.gactualizar');

    Route::get('actualizarMascota', 'MascotasController@index')->name('secretaria.actualizarMascota');
    Route::get('actualizarMascota/{cod_expediente?}', 'MascotasController@edit')->name('secretaria.actualizarMascota');
    Route::put('actualizarMascota/{cod_expediente?}', 'MascotasController@update')->name('secretaria.gactualizarMascota');

    Route::get('actualizarPropietario', 'PropietarioController@index')->name('secretaria.actualizarPropietario');
    Route::get('actualizarPropietario/{cod_propietario?}', 'PropietarioController@editar')->name('secretaria.actualizarPropietario');
    Route::put('actualizarPropietario/{cod_propietario?}', 'PropietarioController@update')->name('secretaria.gactualizarPropietario');

});

/*
 * VETERINARIO
 * */
Route::group(['prefix'=>'veterinario', 'namespace' =>'Veterinario', 'middleware'=> ['auth','veterinario']],function (){
    Route::get('dashboard', 'DashboardController@index')->name('veterinario.dashboard');
    Route::get('consulta', 'ConsultaController@index')->name('veterinario.consulta');
    Route::get('vacuna', 'VacunasController@index')->name('veterinario.vacunas');

    Route::get('atender/{cod_expediente}/{cod_consulta}', 'ConsultaController@create')->name('veterinario.atender');
    Route::put('atender/{cod_consulta}', 'ConsultaController@update')->name('veterinario.gconsulta');

    Route::get('atenderVacuna/{cod_expediente}/{cod_control_vacunas}', 'VacunasController@create')->name('veterinario.atenderVacuna');
    Route::put('atenderVacuna/{cod_control_vacunas}', 'VacunasController@update')->name('veterinario.gvacuna');
});

/*
 *  INVENTARIO
 * */
Route::group(['prefix'=>'inventario', 'namespace' =>'Inventario'],function (){
    Route::get('dashboard', 'DashboardController@index')->name('inventario.dashboard')->middleware('auth','inventario');
});



