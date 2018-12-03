<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Proyecto;
use Carbon\Carbon;
use Validator;
use Excel;
use Auth;
use DB;
use Mail;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class ProyectoCtrl extends Controller
{
    public function index()
    {
        
        return view('proyecto.index');
    }

    public function listar()
    {
        $proyectos = DB::table('proyectos')
            ->select('id','nombre','descripcion','inicio','fin')
            ->paginate(10);       
        return view('proyecto.listar', compact('proyectos'));
    }



    public function getProyectos()
    {
        $data = array(); //declaramos un array principal que va contener los datos

        $proyectos = DB::table('proyectos')
            ->select('id','nombre')
            ->get();

        return $proyectos->toJson();
    }

    public function getEmpleadosProyecto($idProyecto)
    {
        $empleados = DB::table('empleadosproyecto')
            ->leftJoin('empleados', 'empleadosproyecto.idEmpleado', '=', 'empleados.id')
            ->select('empleadosproyecto.id',
                    'empleadosproyecto.idProyecto',
                    'empleadosproyecto.idEmpleado',
                    'empleados.nombres',
                    'empleados.apellidos')
            ->where('empleadosproyecto.idProyecto', $idProyecto)
            ->orderBy('empleados.apellidos','asc')
            ->get();
        return $empleados->toJson();

    }


    public function getTurnosProyecto($idProyecto)
    {
        
        $turnos = DB::table('turnosproyecto')
            ->leftJoin('turnos', 'turnosproyecto.idTurno', '=', 'turnos.id')
            ->select('turnos.id',
                    'turnosproyecto.idProyecto',
                    'turnosproyecto.idTurno',
                    'turnos.codigo',
                    'turnos.descripcion')
            ->where('turnosproyecto.idProyecto', $idProyecto)
            ->orderBy('turnos.id','asc')
            ->get();
            return $turnos->toJson();
    }

    public function getTipoMarcacion($idEmpleado)
    {

        $now =  date('Y-m-d H:i:s');     
        $marcacion = Marcacion::whereDate('entrada', Carbon::today())->where('idEmpleado',$idEmpleado)->first();  
        if (empty($marcacion)) {
            $tipoMarcacion = 'Entrada';
        } else {
            $tipoMarcacion = 'Salida';
        }
        
        return response()->json(['tipoMarcacion'=>$tipoMarcacion]);

    }


    public function marcar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'Proyecto' => 'required',
            'Empleado' => 'required',
            'Turno' => 'required',
        ]);

        if ($validator->passes()) {
            $tipoMarcacion=$request->tipo_marcacion;
            $idEmpleado = $request->Empleado;
            $now =  date('Y-m-d H:i:s');
            if ($tipoMarcacion == 'Entrada') {
                





                $marcacion = new Marcacion();       
                $marcacion->idEmpleado = $request->Empleado;
                $marcacion->idTurno = $request->Turno;
                $marcacion->entrada = $now;
                $marcacion->save();
                return response()->json(['success'=>'Se registró correctamente']);
            } elseif ($tipoMarcacion == 'Salida') {  
/*//convertimos la fecha 1 a objeto Carbon
$carbon1 = new \Carbon\Carbon("2018-01-01 00:00:00");
//convertimos la fecha 2 a objeto Carbon
$carbon2 = new \Carbon\Carbon("2018-02-02 00:00:00");
//de esta manera sacamos la diferencia en minutos
$minutesDiff=$carbon1->diffInMinutes($carbon2);
*/
                $marcacion = Marcacion::whereDate('entrada', Carbon::today())->where('idEmpleado',$idEmpleado)->first(); 

                $entrada = $marcacion->entrada;//convertimos la fecha 1 a objeto Carbon
                $carbon1 = new \Carbon\Carbon($entrada);
                //convertimos la fecha 2 a objeto Carbon
                $carbon2 = new \Carbon\Carbon($now);
                //de esta manera sacamos la diferencia en minutos
                $minutesDiff=$carbon1->diffInMinutes($carbon2);
                //$minutesDiff = 542;

                $hEfectivas = $minutesDiff/60;
                $mEfectivas = $minutesDiff%60;
                if ($hEfectivas>8) {
                    --$hEfectivas;
                }

                $marcacion->idEmpleado = $request->Empleado;
                $marcacion->idTurno = $request->Empleado;
                $marcacion->salida = $now;

                $marcacion->horasEfectivas = $hEfectivas;
                $marcacion->minutosEfectivos = $mEfectivas;
                $marcacion->save();
                return response()->json(['success'=>'Se registró correctamente']);
            } 
            
/*GRABAR
            $now =  date('Y-m-d H:i:s');
            $marcacion = new Marcacion();       
            $marcacion->idEmpleado = $request->idEmpleado;
            $marcacion->idTurno = $request->idEmpleado;
            $marcacion->entrada = $now;
            $marcacion->save();

            return response()->json(['success'=>'Se registró correctamente']);
*/

/*ACTUALIZAR
            $now =  date('Y-m-d H:i:s');     
            $marcacion = Marcacion::whereDate('entrada', Carbon::today())->where('idEmpleado',$idEmpleado)->first();  
            $marcacion->idEmpleado = $request->idEmpleado;
            $marcacion->idTurno = $request->idEmpleado;
            $marcacion->salida = $now;
            $marcacion->save();

            return response()->json(['success'=>'Se registró correctamente']);

*/
        } 

        return response()->json(['error'=>$validator->errors()->all()]); 

    }




    public function marcacion()
    {
        $proyectos = DB::table('proyectos')
        ->select('id','nombre')
        ->get();
        return view('asistencia.marcacion',compact('proyectos'));
    }

    public function listar1($fdesde,$fhasta,$cardid)
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
    
    public function indexReporte()
    {
        $usersinfo = DB::table('USERINFO')
            ->select('CardNo as cardid','name as nombre')
            ->get();        

    }

    public function indexRptMensual()
    {
        $usersinfo = DB::table('USERINFO')
        ->select('CardNo as cardid','name as nombre')
        ->get();
        return view('Asistencia.indexRptMes',compact('usersinfo'));       

    }

    public function rptMensual($mes,$cardid)
    {
        setlocale(LC_TIME, "es_PE.UTF-8");
        $asistencias = array();
        //$cardid = '6176060';
        $temp   = 0;
        $dia    = 1;
        $mes    = (int)substr($mes,0,2);
        $anio   = 2017;
        $count  = 0;      
        $desc  = '';      
        
        $totSeg  = 0;      
        $totHoras  = strtotime('00:00:00');      
        $usersinfo = DB::table('USERINFO')
            ->select('CardNo as cardid','name as nombre')
            ->get();  


        //$dia= date("d",mktime(0,0,0,$mes,$dia,$anio));                         
        $date = $anio.'-'.$mes.'-'.$dia;
        
            while($temp<$dia)
            {        
                $dif = 0;                
                $dia= date("d",mktime(0,0,0,$mes,$dia,$anio));                         
                $date = $anio.'-'.$mes.'-'.$dia;                
                $hinicio = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->orderBy('acc_monitor_log.time','asc')
                ->first();

                $hfin = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->orderBy('acc_monitor_log.time','desc')
                ->first();


                $eventos = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.event_type',
                    'acc_monitor_log.time',
                    'acc_monitor_log.description')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->where('acc_monitor_log.event_type','=',1000)
                ->where('acc_monitor_log.description','<>','')
                ->orderBy('acc_monitor_log.time','desc')
                ->get();

                // concatenar todos los campos description
                foreach ($eventos as $evento) {
                    $desc=$desc.' / '.(date('H:i', strtotime( $evento->time ))).' - '.$evento->description;
                }

                if(empty($hinicio)){
                    $hinicio = '';
                }else{
                    $hinicio=$hinicio->time;
                }
                if(empty($hfin)){
                    $hfin='';
                }else{
                    $hfin=$hfin->time;
                }
                if (!empty($hinicio) && !empty($hfin) ) {
                    
                    $horaini = date('H:i:s', strtotime( $hinicio ));
                    $horafin = date('H:i:s', strtotime( $hfin ));
                
                
                    $horai=substr($horaini,0,2);
                    $mini=substr($horaini,3,2);
                    $segi=substr($horaini,6,2);
                
                    $horaf=substr($horafin,0,2);
                    $minf=substr($horafin,3,2);
                    $segf=substr($horafin,6,2);
                
                    $ini=((($horai*60)*60)+($mini*60)+$segi);
                    $fin=((($horaf*60)*60)+($minf*60)+$segf);
                
                    $dif=$fin-$ini;
                
                    $difh=floor($dif/3600);
                    $difm=floor(($dif-($difh*3600))/60);
                    $difs=$dif-($difm*60)-($difh*3600);
                    $dteDiff = date("H:i:s",mktime($difh,$difm,$difs));

                }else{
                    $dteDiff = '';
                }


                
                //$totHoras = $totHoras + $
                //Tiempo total mes acumulado
                $totSeg = $totSeg + $dif;
                $difhor=floor($totSeg/3600);
                $difmin=floor(($totSeg-($difhor*3600))/60);
                $difseg=$totSeg-($difmin*60)-($difhor*3600);
                $totHoras = $difhor.' h - '.$difmin.' m - '.$difseg.' s';


                $asistencias[$temp][0] = $date;
                $asistencias[$temp][1] = $hinicio;
                $asistencias[$temp][2] = $hfin;
                $asistencias[$temp][3] = $dteDiff;
                $asistencias[$temp][4] = $desc;
                $tot = $temp;
                $temp++;
                $dia++;
                $desc = '';
            }
       
        return view('Asistencia.rptMes',compact('cardid','asistencias','tot','totHoras','totSeg'));
    }

    public function nuevoEvento($id)
    {        
        return view('Asistencia.nuevoEvento');
    }

    public function editEvento($id)
    {
        $evento = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time',
                    'acc_monitor_log.description')
                ->where('acc_monitor_log.id',$id)
                ->first();

        return view('Asistencia.editarEvento',compact('evento'));
    }

    public function actEvento(Request $request,$id)
    {
        $evento = MonitorLog::find($id);
        $evento->description = $request->description;
        $evento->save();

        Mail::send('Asistencia.msgUpdtAsist', compact('evento'), function ($m) use ($evento) 
        {
            $m->from('no-reply@corpibgroup.com', 'DNP Corp - Asistencia');

            //$m->to('contabilidad@dnp.com.pe','Rosa Carbajal Gomez')->subject('Justificacion de Asistencia');
            $m->to('sistemas@datanetworkperu.com','Rosa Carbajal Gomez')->subject('Justificacion de Asistencia');
        });
        
    }







    public function exportAsistMes($mes,$cardid)
    {
        $anio   = (int)substr($mes,3,7);//02-2017        
        $mes    = (int)substr($mes,0,2);
        $userinfo = DB::table('USERINFO')
            ->select('CardNo as cardid','name as nombre')
            ->where('CardNo',$cardid)
            ->first(); 
        Excel::create('Rpt-Asis_'.str_replace(" ", "-", $userinfo->nombre).'_'.$mes.'-'.$anio, function($excel) use($mes,$anio,$cardid,$userinfo) {
            $excel->sheet('Sheet 1', function($sheet) use($mes,$anio,$cardid,$userinfo)
            {

        $asistencias = array();
        //$cardid = '6176060';
        $temp   = 0;
        $dia    = 1;
        
        $count  = 0;      
        $desc  = '';      
        
        $totSeg  = 0;      
        $totHoras  = strtotime('00:00:00');      
        
        $data=[];

        array_push($data, array('','Reporte de Asistencia','','',''));
        array_push($data, array('','','','',''));
        array_push($data, array('Nombre:',$userinfo->nombre,'',/*'H.Trabajadas'*/'','')); 
        array_push($data, array('Dia','Entrada','Salida','T.Horas','Justificación'));

        //$dia= date("d",mktime(0,0,0,$mes,$dia,$anio));                         
        $date = $anio.'-'.$mes.'-'.$dia;
        
            while($temp<$dia)
            {        
                $dif = 0;                
                $dia= date("d",mktime(0,0,0,$mes,$dia,$anio));                         
                $date = $anio.'-'.$mes.'-'.$dia;                
                $hinicio = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->orderBy('acc_monitor_log.time','asc')
                ->first();

                $hfin = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.time')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->orderBy('acc_monitor_log.time','desc')
                ->first();


                $eventos = DB::table('acc_monitor_log')
                ->leftJoin('USERINFO','acc_monitor_log.card_no','=','USERINFO.CardNo')
                ->select('acc_monitor_log.card_no as cardid',
                    'USERINFO.name as nombre',
                    'USERINFO.lastname as apellido',
                    'acc_monitor_log.id',
                    'acc_monitor_log.event_point_id',
                    'acc_monitor_log.event_type',
                    'acc_monitor_log.time',
                    'acc_monitor_log.description')
                ->where('acc_monitor_log.card_no','=',$cardid)
                ->where('acc_monitor_log.time','>=',$date.' 00:00:00.000')
                ->where('acc_monitor_log.time','<=',$date.' 23:59:59.000')
                ->where('acc_monitor_log.event_type','=',1000)
                ->where('acc_monitor_log.description','<>','')
                ->orderBy('acc_monitor_log.time','desc')
                ->get();
                 

                // concatenar todos los campos description
                foreach ($eventos as $evento) {
                    $desc=$desc.' / '.(date('H:i', strtotime( $evento->time ))).' - '.$evento->description;
                }

                if(empty($hinicio)){
                    $hinicio = '';
                }else{
                    $hinicio=$hinicio->time;
                }
                if(empty($hfin)){
                    $hfin='';
                }else{
                    $hfin=$hfin->time;
                }
                if (!empty($hinicio) && !empty($hfin) ) {
                    
                    $horaini = date('H:i:s', strtotime( $hinicio ));
                    $horafin = date('H:i:s', strtotime( $hfin ));
                
                
                    $horai=substr($horaini,0,2);
                    $mini=substr($horaini,3,2);
                    $segi=substr($horaini,6,2);
                
                    $horaf=substr($horafin,0,2);
                    $minf=substr($horafin,3,2);
                    $segf=substr($horafin,6,2);
                
                    $ini=((($horai*60)*60)+($mini*60)+$segi);
                    $fin=((($horaf*60)*60)+($minf*60)+$segf);
                
                    $dif=$fin-$ini;
                
                    $difh=floor($dif/3600);
                    $difm=floor(($dif-($difh*3600))/60);
                    $difs=$dif-($difm*60)-($difh*3600);
                    $dteDiff = date("H:i:s",mktime($difh,$difm,$difs));

                }else{
                    $dteDiff = '';
                }


                //Tiempo total mes acumulado
                $totSeg = $totSeg + $dif;
                $difhor=floor($totSeg/3600);
                $difmin=floor(($totSeg-($difhor*3600))/60);
                $difseg=$totSeg-($difmin*60)-($difhor*3600);
                $totHoras = $difhor.' h - '.$difmin.' m - '.$difseg.' s';

                if ($hinicio !='') {
                    $tmpIni = date('H:i:s a', strtotime( $hinicio ));
                }else{
                    $tmpIni = '';
                }
                if ($hfin !='') {
                    $tmpFin = date('H:i:s a', strtotime( $hfin ));
                }else{
                    $tmpFin = '';
                }


                array_push($data, array(
                    date('D d \d\e F', strtotime($date)),
                    $tmpIni,
                    $tmpFin,
                    $dteDiff,
                    $desc
                ));
                $tot = $temp;
                $temp++;
                $dia++;
                $desc = '';
            }


                                   
                
                    
                $sheet->setBorder('A4:E'.($tot+4),'thin');
                
                $sheet->mergeCells('B1:D1');
                $sheet->mergeCells('B3:C3');
                $sheet->cells('B1:D1',function($cells){
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(14);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A3',function($cells){
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('D3',function($cells){
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A4:E4',function($cells){
                    $cells->setFontFamily('Calibri');
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                array_pop($data);
                $sheet->fromArray($data,null,'A1',false, false);
            });
        })->download('xlsx');

    }











}