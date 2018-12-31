<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Turno;
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
class TurnoCtrl extends Controller
{
    public function index()
    {
        
        return view('turno.index');
    }

    public function listar()
    {
        $turnos = DB::table('turnos')
            ->select('id','codigo','descripcion','created_at')
            ->paginate(10);       
        return view('turno.listar', compact('turnos'));
    }




/*  inicioTemplate
*/


    
    public function buscar($consulta)
    {

        $turnos = DB::table('empleados') 
            ->leftJoin('empleadosproyecto', 'empleados.id', '=', 'empleadosproyecto.idEmpleado')
            ->leftJoin('proyectos', 'empleadosproyecto.idProyecto', '=', 'proyectos.id')
            ->select('empleados.id','empleados.codigo','empleados.nombres','empleados.apellidos','empleados.activo','empleados.created_at','proyectos.id as idProyecto','proyectos.nombre as proyecto')
            ->where('empleados.nombres', 'LIKE', '%'.$consulta.'%')
            ->orwhere('empleados.apellidos', 'LIKE', '%'.$consulta.'%')
            ->orwhere('proyectos.nombre', 'LIKE', '%'.$consulta.'%')
            ->orderBy('empleados.created_at','desc')
            ->paginate(20);  


            $turnos = DB::table('turnos')
            ->select('id','codigo','descripcion','created_at')
            ->where('codigo', 'LIKE', '%'.$consulta.'%')
            ->orwhere('descripcion', 'LIKE', '%'.$consulta.'%')
            ->orderBy('created_at','desc')
            ->paginate(10); 
            
        return view('turno.listar', compact('turnos'));
    }

    public function nuevo()
    {
        $turnos = Turno::where('idRol','<=','3')->where('estado',1)->get();
        return view('turno.nuevo',compact('turnos'));
    }

    public function editar($id)
    {
        $lead = Lead::find($id);
        $turnos = User::where('idRol','<=','3')->where('estado',1)->get();
        return view('turno.editar', compact('lead','turnos'));
    }

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required',
            'Correo' => 'required|email|unique:leads',
        ]);

        if ($validator->passes()) {

            $idUsuario = Auth::user()->id;
            $now =  strtotime($request->fec_fech_inic);
            $lead = new Empleado();
            $lead->UsuarioID = $request->UsuarioID;
            $lead->Nombre = $request->Nombre;
            $lead->Correo = $request->Correo;
            $lead->Empresa = $request->Empresa;
            $lead->Comentario = $request->Comentario;
            $lead->Requerimientos = $request->Requerimientos;
            $lead->cod_usua_crea = $idUsuario;
            $lead->created_at = date('Y-m-d H:i:s');  
            $lead->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'required',
            'Correo' => 'required|email',
        ]);

        if ($validator->passes()) {

            $idUsuario = Auth::user()->id;
            $now =  strtotime($request->fec_fech_inic);
            $lead = Lead::find($request->leadID);
            $lead->UsuarioID = $request->UsuarioID;
            $lead->Nombre = $request->Nombre;
            $lead->Correo = $request->Correo;
            $lead->Empresa = $request->Empresa;
            $lead->Comentario = $request->Comentario;
            $lead->Requerimientos = $request->Requerimientos;
            $lead->cod_usua_modi = $idUsuario;
            $lead->updated_at = date('Y-m-d H:i:s'); 
            $lead->save();

            return response()->json(['success'=>'Se actualizó correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]); 
    }

    public function eliminar($id)
    {
        $proyecto = Proyecto::find($id)->delete();
    }

    public function info($id)
    {

        $proyecto = Lead::leftJoin('users as u', 'leads.UsuarioID','=','u.id')
            ->select('leads.id',
                'leads.Nombre',
                'leads.Correo',
                'leads.Empresa',
                'leads.Comentario',
                'leads.Requerimientos',
                'leads.created_at',
                'leads.updated_at',
                'u.id','u.cod_usua_sgmc')
            ->where('leads.id',$id)
            ->first();

        return view('proyecto.infoProyecto',compact('proyecto'));
    }




/*  finTemplate
*/






}