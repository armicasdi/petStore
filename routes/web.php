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
//Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('reporteproductos', 'ReporteProductosController@index')->name('admin.reporte');

    Route::get('reporteproductos/pdf', 'ReporteProductosController@pdf')->name('pdf2');
    Route::post('agregar', 'EmpleadosController@store')->name('admin.gagregar');

    // MANTENIMIENTO
    Route::get('vacunas', 'Mantto\VacunasController@index')->name('vacunas');
    Route::get('vacunasfagregar', 'Mantto\VacunasController@create')->name('vacuna.fagregar');
    Route::post('vacunas', 'Mantto\VacunasController@store')->name('vacuna.agregar');
    Route::get('vacunasfactuzaliar/{cod_vacuna}', 'Mantto\VacunasController@edit')->name('vacuna.factualizar');
    Route::put('vacunas/{cod_vacuna}', 'Mantto\VacunasController@update')->name('vacuna.actualizar');
    Route::delete('vacunas/{cod_vacuna}', 'Mantto\VacunasController@destroy')->name('vacuna.eliminar');
    Route::put('vacunasBloquear/{cod_vacuna}', 'Mantto\VacunasController@bloquear')->name('vacuna.bloquear');

    Route::get('servicios', 'Mantto\ServiciosPeluqueriaController@index')->name('servicios');
    Route::get('serviciosfagregar', 'Mantto\ServiciosPeluqueriaController@create')->name('servicio.fagregar');
    Route::post('servicios', 'Mantto\ServiciosPeluqueriaController@store')->name('servicio.agregar');
    Route::get('serviciosfactuzaliar/{cod_tipo_servicio}', 'Mantto\ServiciosPeluqueriaController@edit')->name('servicio.factualizar');
    Route::put('servicios/{cod_tipo_servicio}', 'Mantto\ServiciosPeluqueriaController@update')->name('servicio.actualizar');
    Route::delete('servicios/{cod_tipo_servicio}', 'Mantto\ServiciosPeluqueriaController@destroy')->name('servicio.eliminar');
    Route::put('serviciosBloquear/{cod_tipo_servicio}', 'Mantto\ServiciosPeluqueriaController@bloquear')->name('servicio.bloquear');

    Route::get('especies', 'Mantto\EspecieController@index')->name('especies');
    Route::get('especiefagregar', 'Mantto\EspecieController@create')->name('especie.fagregar');
    Route::post('especie', 'Mantto\EspecieController@store')->name('especie.agregar');
    Route::get('especiefactuzaliar/{cod_especie}', 'Mantto\EspecieController@edit')->name('especie.factualizar');
    Route::put('especie/{cod_especie}', 'Mantto\EspecieController@update')->name('especie.actualizar');
    Route::delete('especie/{cod_especie}', 'Mantto\EspecieController@destroy')->name('especie.eliminar');
    Route::put('especieBloquear/{cod_especie}', 'Mantto\EspecieController@bloquear')->name('especie.bloquear');

    Route::get('bodegas', 'Mantto\BodegaController@index')->name('bodegas');
    Route::get('bodegafagregar', 'Mantto\BodegaController@create')->name('bodega.fagregar');
    Route::post('bodega', 'Mantto\BodegaController@store')->name('bodega.agregar');
    Route::get('bodegafactuzaliar/{cod_bodega}', 'Mantto\BodegaController@edit')->name('bodega.factualizar');
    Route::put('bodega/{cod_bodega}', 'Mantto\BodegaController@update')->name('bodega.actualizar');
    Route::delete('bodega/{cod_bodega}', 'Mantto\BodegaController@destroy')->name('bodega.eliminar');
    Route::put('bodegaBloquear/{cod_bodega}', 'Mantto\BodegaController@bloquear')->name('bodega.bloquear');

    Route::get('tiposProductos', 'Mantto\TipoProductoController@index')->name('tiposProductos');
    Route::get('tipoProductofagregar', 'Mantto\TipoProductoController@create')->name('tipoProducto.fagregar');
    Route::post('tipoProducto', 'Mantto\TipoProductoController@store')->name('tipoProducto.agregar');
    Route::get('tipoProductofactuzaliar/{cod_tipo_producto}', 'Mantto\TipoProductoController@edit')->name('tipoProducto.factualizar');
    Route::put('tipoProducto/{cod_tipo_producto}', 'Mantto\TipoProductoController@update')->name('tipoProducto.actualizar');
    Route::delete('tipoProducto/{cod_tipo_producto}', 'Mantto\TipoProductoController@destroy')->name('tipoProducto.eliminar');
    Route::put('tipoProductoBloquear/{cod_tipo_producto}', 'Mantto\TipoProductoController@bloquear')->name('tipoProducto.bloquear');

    Route::get('razas', 'Mantto\RazaController@index')->name('razas');
    Route::get('razafagregar', 'Mantto\RazaController@create')->name('raza.fagregar');
    Route::post('raza', 'Mantto\RazaController@store')->name('raza.agregar');
    Route::get('razafactuzaliar/{cod_raza}', 'Mantto\RazaController@edit')->name('raza.factualizar');
    Route::put('raza/{cod_raza}', 'Mantto\RazaController@update')->name('raza.actualizar');
    Route::delete('raza/{cod_raza}', 'Mantto\RazaController@destroy')->name('raza.eliminar');
    Route::put('razaBloquear/{cod_raza}', 'Mantto\RazaController@bloquear')->name('raza.bloquear');

    //Mascotas
    Route::get('reporteMascotas', 'ReporteMascotasController@index')->name('admin.reporteMascotas');
    Route::get('reporteMascotas/pdf', 'ReporteMascotasController@pdf')->name('pdf');

    Route::get('chartjs', 'GraficaController@chartjs')->name('grafica');


       //Historia 7
    Route::get('reporteAtencion', 'atencionMascotasReporte@index')->name('admin.reporteAtencion');
    Route::get('registroAtencion/{servicio}/{mes}/{year}/{semana?}', 'atencionMascotasReporte@registro');
    Route::get('registroAtencion/{servicio}/{mes}/{year}/{semana?}/pdf', 'atencionMascotasReporte@pdf')->name('admin.reporteAtenciones');

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

    Route::get('ingresoproducto','IngresoProductoController@index')->name('inventario.ingreso')->middleware('auth', 'inventario');
});




