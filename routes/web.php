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
*/

Route::get('/', function () {
    return view('home');
});


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

        
    });



 Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});