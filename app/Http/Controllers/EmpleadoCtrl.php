<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Empleado;
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
class EmpleadoCtrl extends Controller
{
    public function index()
    {
        
        return view('empleado.index');
    }

    public function listar()
    {
        $empleados = DB::table('empleados') 
            ->leftJoin('empleadosproyecto', 'empleados.id', '=', 'empleadosproyecto.idEmpleado')
            ->leftJoin('proyectos', 'empleadosproyecto.idProyecto', '=', 'proyectos.id')
            ->select('empleados.id','empleados.codigo','empleados.nombres','empleados.apellidos','empleados.activo','empleados.created_at','proyectos.id as idProyecto','proyectos.nombre as proyecto')
            ->paginate(20);       
        return view('empleado.listar', compact('empleados'));
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



/*  inicioTemplate
*/


    
    public function buscar($consulta)
    {

        $empleados = DB::table('empleados') 
            ->leftJoin('empleadosproyecto', 'empleados.id', '=', 'empleadosproyecto.idEmpleado')
            ->leftJoin('proyectos', 'empleadosproyecto.idProyecto', '=', 'proyectos.id')
            ->select('empleados.id','empleados.codigo','empleados.nombres','empleados.apellidos','empleados.activo','empleados.created_at','proyectos.id as idProyecto','proyectos.nombre as proyecto')
            ->where('empleados.nombres', 'LIKE', '%'.$consulta.'%')
            ->orwhere('empleados.apellidos', 'LIKE', '%'.$consulta.'%')
            ->orwhere('proyectos.nombre', 'LIKE', '%'.$consulta.'%')
            ->orderBy('empleados.created_at','desc')
            ->paginate(20);  
            
        return view('empleado.listar', compact('empleados'));
    }

    public function nuevo()
    {
        $empleados = User::where('idRol','<=','3')->where('estado',1)->get();
        return view('empleado.nuevo',compact('empleados'));
    }

    public function editar($id)
    {
        $lead = Lead::find($id);
        $empleados = User::where('idRol','<=','3')->where('estado',1)->get();
        return view('empleado.editar', compact('lead','empleados'));
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