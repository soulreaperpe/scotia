<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MarcacionCtrl extends Controller
{
    public function index()
    {
        $proyectos = DB::table('proyectos')
        ->select('id','nombre')
        ->get();
        $empleados = DB::table('empleados')
        ->select('id','nombres','apellidos','activo')
        ->where('activo',true);
        ->get();
        $turnos = DB::table('turnos')
        ->select('id','codigo')
        ->get();
        return view('home',compact('proyectos','empleados','turnos');
    }

    public function listar($fdesde,$fhasta,$cardid)
    {
        $desde =  strtotime($fdesde);
        $hasta =  strtotime($fhasta);
        if($cardid=='todos'){
            $asistencias = MonitorLog::leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time',
                    'acc_monitor_log.description')
                ->where('acc_monitor_log.card_no','!=','')
                ->where('acc_monitor_log.time','>=',date('Y-m-d 00:00:00.000',$desde))
                ->where('acc_monitor_log.time','<=',date('Y-m-d 23:59:59.000',$hasta))
                ->orderBy('acc_monitor_log.time','desc')
                ->paginate(30);
        }else{
            $asistencias = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time',
                    'acc_monitor_log.description')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',date('Y-m-d 00:00:00.000',$desde))
                ->where('acc_monitor_log.time','<=',date('Y-m-d 23:59:59.000',$hasta))
                ->orderBy('acc_monitor_log.time','desc')
                ->paginate(30);
        }
        return view('Asistencia.listar',compact('asistencias'));
    }
}
