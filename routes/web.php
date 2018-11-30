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
Route::get('/',['uses' => 'AsistenciaCtrl@marcacion','as'=>'indexAsistencia']); 


Route::get('/marcacion', function () {
    return view('/asistencia/marcacion');
});




Route::group(['prefix' => 'asistencia'], function(){
        Route::get('/',['uses' => 'AsistenciaCtrl@index','as'=>'indexAsistencia']);  
       	Route::get('/{id}/editar',['uses'=>'AsistenciaCtrl@editEvento','as'=>'editarEventoAsis']);
       	Route::post('/{id}/actualizar',['uses'=>'AsistenciaCtrl@actEvento','as'=>'actualizarEventoAsistencia']);
       	Route::get('/reporte/{fdesde}/{fhasta}/{cardid}/{page?}',['uses' => 'AsistenciaCtrl@listar','as'=>'rptAsistencia']);   
        Route::get('/mes',['uses' => 'AsistenciaCtrl@indexRptMensual','as'=>'indexRptMensual']);
        Route::get('/mes/{mes}/{cardid}',['uses' => 'AsistenciaCtrl@rptMensual','as'=>'rptMensual']); 
        //Export to excel - Asistencia Mes por Usuario
        Route::get('/mes/{mes}/{cardid}/export2excel',['uses' => 'AsistenciaCtrl@exportAsistMes','as'=>'rptMensualExport2Excel']);  
		// Scotiabank Marcacion
        Route::group(['prefix' => 'marcacion'], function(){
        	Route::get('/tipoMarcacion/{idEmpleado}',['uses'=>'AsistenciaCtrl@getTipoMarcacion','as'=>'getTipoMarcacion']);
        	Route::post('/marcar',['uses'=>'AsistenciaCtrl@marcar','as'=>'marcar']);
        	Route::get('/proyectos',['uses'=>'AsistenciaCtrl@getProyectos','as'=>'getProyectos']);
        	Route::get('/proyecto/{idProyecto}/empleados',['uses'=>'AsistenciaCtrl@getEmpleadosProyecto','as'=>'getEmpleadosProyecto']);
        	Route::get('/proyecto/{idProyecto}/turnos',['uses'=>'AsistenciaCtrl@getTurnosProyecto','as'=>'getTurnosProyecto']);
        });
        
});


    Route::group(['prefix' => 'proyecto'], function(){
        Route::get('/',['uses' => 'ProyectoCtrl@index','as'=>'roles']);        
        Route::get('/listar/{page?}',['uses' => 'ProyectoCtrl@listar','as'=>'listarroles']);        
        Route::get('/nuevo',['uses'=>'ProyectoCtrl@nuevo','as'=>'nuevorol']);
        Route::post('/grabar',['uses'=>'ProyectoCtrl@grabar','as'=>'grabarrol']);
        Route::get('/{id}/editar',['uses'=>'ProyectoCtrl@editar','as'=>'editarrol']);
        Route::post('/{id}/actualizar',['uses'=>'ProyectoCtrl@actualizar','as'=>'actualizarrol']);
        Route::get('/{id}/eliminar',['uses'=>'ProyectoCtrl@eliminar','as'=>'eliminarrol']);
        Route::get('/buscar/',['uses'=>'ProyectoCtrl@listar','as'=>'buscarrol']);
        Route::get('/buscar/{consulta}',['uses'=>'ProyectoCtrl@buscar','as'=>'buscarrol']);
    });


    Route::group(['prefix' => 'empleado'], function(){
        Route::get('/',['uses' => 'EmpleadoCtrl@indexEmpleadoCtrl','as'=>'roles']);        
        Route::get('/listar/{page?}',['uses' => 'EmpleadoCtrl@listar','as'=>'listarroles']);        
        Route::get('/nuevo',['uses'=>'EmpleadoCtrl@nuevo','as'=>'nuevorol']);
        Route::post('/grabar',['uses'=>'EmpleadoCtrl@grabar','as'=>'grabarrol']);
        Route::get('/{id}/editar',['uses'=>'EmpleadoCtrl@editar','as'=>'editarrol']);
        Route::post('/{id}/actualizar',['uses'=>'EmpleadoCtrl@actualizar','as'=>'actualizarrol']);
        Route::get('/{id}/eliminar',['uses'=>'EmpleadoCtrl@eliminar','as'=>'eliminarrol']);
        Route::get('/buscar/',['uses'=>'EmpleadoCtrl@listar','as'=>'buscarrol']);
        Route::get('/buscar/{consulta}',['uses'=>'EmpleadoCtrl@buscar','as'=>'buscarrol']);
    });

    Route::group(['prefix' => 'turno'], function(){
        Route::get('/',['uses' => 'TurnoCtrl@indexEmpleadoCtrl','as'=>'roles']);        
        Route::get('/listar/{page?}',['uses' => 'TurnoCtrl@listar','as'=>'listarroles']);        
        Route::get('/nuevo',['uses'=>'TurnoCtrl@nuevo','as'=>'nuevorol']);
        Route::post('/grabar',['uses'=>'TurnoCtrl@grabar','as'=>'grabarrol']);
        Route::get('/{id}/editar',['uses'=>'TurnoCtrl@editar','as'=>'editarrol']);
        Route::post('/{id}/actualizar',['uses'=>'TurnoCtrl@actualizar','as'=>'actualizarrol']);
        Route::get('/{id}/eliminar',['uses'=>'TurnoCtrl@eliminar','as'=>'eliminarrol']);
        Route::get('/buscar/',['uses'=>'TurnoCtrl@listar','as'=>'buscarrol']);
        Route::get('/buscar/{consulta}',['uses'=>'TurnoCtrl@buscar','as'=>'buscarrol']);
    });






 Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});