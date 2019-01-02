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
Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('home');
});*/
Route::get('/','AsistenciaCtrl@marcacion')->name('indexAsistencia'); 

Route::get('/marcacion', function () {
    return view('/asistencia/marcacion');
});

Route::prefix('asistencia')->group(function () {   
    Route::get('/','AsistenciaCtrl@index')->name('indexAsistencia');  
    Route::get('/listar/{page?}','AsistenciaCtrl@listar')->name('listarroles'); 
    Route::get('/{id}/editar','AsistenciaCtrl@editEvento')->name('editarEventoAsis');
    Route::post('/{id}/actualizar','AsistenciaCtrl@actEvento')->name('actualizarEventoAsistencia');
    Route::get('/reporte/{fdesde}/{fhasta}/{cardid}/{page?}','AsistenciaCtrl@listar')->name('rptAsistencia');   
    Route::get('/mes','AsistenciaCtrl@indexRptMensual')->name('indexRptMensual');
    Route::get('/mes/{mes}/{cardid}','AsistenciaCtrl@rptMensual')->name('rptMensual'); 
    //Export to excel - Asistencia Mes por Usuario
    Route::get('/mes/{mes}/{cardid}/export2excel','AsistenciaCtrl@exportAsistMes')->name('rptMensualExport2Excel');  

	// Scotiabank Marcacion
    Route::prefix('marcacion')->group(function () {   
        Route::get('/tipoMarcacion/{idEmpleado}','AsistenciaCtrl@getTipoMarcacion')->name('getTipoMarcacion');
        Route::post('/marcar','AsistenciaCtrl@marcar')->name('marcar');
        Route::get('/proyectos','AsistenciaCtrl@getProyectos')->name('getProyectos');
        Route::get('/proyecto/{idProyecto}/empleados','AsistenciaCtrl@getEmpleadosProyecto')->name('getEmpleadosProyecto');
        Route::get('/proyecto/{idProyecto}/turnos','AsistenciaCtrl@getTurnosProyecto')->name('getTurnosProyecto');
    });

        // Reporte
    Route::prefix('reporte')->group(function () {    
        Route::post('/empleado','AsistenciaCtrl@reporteEmpleado')->name('reporteEmpleado');            
    });
        
});




Route::middleware('auth')->group(function () {

 	Route::get('/dashboard','AsistenciaCtrl@marcacion')->name('dashboard');
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes 


    Route::prefix('proyecto')->group(function () {    
        Route::get('/','ProyectoCtrl@index')->name('proyectos');        
        Route::get('/listar/{page?}','ProyectoCtrl@listar')->name('listarProyectos');        
        Route::get('/nuevo','ProyectoCtrl@nuevo')->name('nuevorol');
        Route::post('/grabar','ProyectoCtrl@grabar')->name('grabarProyecto');
        Route::get('/{id}/editar','ProyectoCtrl@editar')->name('editarProyecto');
        Route::post('/{id}/actualizar','ProyectoCtrl@actualizar')->name('actualizarProyecto');
        Route::get('/{id}/eliminar','ProyectoCtrl@eliminar')->name('eliminarProyecto');
        Route::get('/buscar/','ProyectoCtrl@listar')->name('buscarProyecto');
        Route::get('/buscar/{consulta}','ProyectoCtrl@buscar')->name('buscarProyecto');
    });

    Route::prefix('empleado')->group(function () {   
        Route::get('/','EmpleadoCtrl@index')->name('empleados');        
        Route::get('/listar/{page?}','EmpleadoCtrl@listar')->name('listarEmpleados');        
        Route::get('/nuevo','EmpleadoCtrl@nuevo')->name('nuevoEmpleado');
        Route::post('/grabar','EmpleadoCtrl@grabar')->name('grabarEmpleado');
        Route::get('/{id}/editar','EmpleadoCtrl@editar')->name('editarEmpleado');
        Route::post('/{id}/actualizar','EmpleadoCtrl@actualizar')->name('actualizarEmpleado');
        Route::get('/{id}/eliminar','EmpleadoCtrl@eliminar')->name('eliminarEmpleado');
        Route::get('/buscar/','EmpleadoCtrl@listar')->name('buscarEmpleado');
        Route::get('/buscar/{consulta}','EmpleadoCtrl@buscar')->name('buscarEmpleado');
    });

    Route::prefix('turno')->group(function () {     
        Route::get('/','TurnoCtrl@index')->name('turnos');        
        Route::get('/listar/{page?}','TurnoCtrl@listar')->name('listarTurnos');        
        Route::get('/nuevo','TurnoCtrl@nuevo')->name('nuevoTurno');
        Route::post('/grabar','TurnoCtrl@grabar')->name('grabarTurno');
        Route::get('/{id}/editar','TurnoCtrl@editar')->name('editarTurno');
        Route::post('/{id}/actualizar','TurnoCtrl@actualizar')->name('actualizarTurno');
        Route::get('/{id}/eliminar','TurnoCtrl@eliminar')->name('eliminarTurno');
        Route::get('/buscar/','TurnoCtrl@listar')->name('buscarTurno');
        Route::get('/buscar/{consulta}','TurnoCtrl@buscar')->name('buscarTurno');
    });




});