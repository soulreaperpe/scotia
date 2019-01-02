<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Empleado;
use App\EmpleadosProyecto;
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
            ->paginate(10);       
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
            ->where('empleados.codigo', 'LIKE', '%'.$consulta.'%')
            ->orwhere('empleados.nombres', 'LIKE', '%'.$consulta.'%')
            ->orwhere('empleados.apellidos', 'LIKE', '%'.$consulta.'%')
            ->orwhere('proyectos.nombre', 'LIKE', '%'.$consulta.'%')
            ->orderBy('empleados.created_at','desc')
            ->paginate(20);  
            
        return view('empleado.listar', compact('empleados'));
    }

    public function nuevo()
    {
        
        return view('empleado.nuevo');
    }

    public function editar($id)
    {
        $empleado = Empleado::find($id);
        $proyectos = $proyectos = DB::table('proyectos')
            ->select('id','nombre')
            ->get();
        $empleadosproyecto = EmpleadosProyecto::where('idEmpleado',$id)
            ->first();
        return view('empleado.editar', compact('empleado','proyectos','empleadosproyecto'));
    }

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nombres' => 'required',
            'Apellidos' => 'required',
            'Proyecto' => 'required',
        ]);

        if ($validator->passes()) {
            $nombres = $request->Nombres;
            $apellidos = $request->Apellidos;
            $idProyecto = $request->Proyecto;

            $empleado = new Empleado();
            $empleado->codigo = $request->Codigo;
            $empleado->nombres = $nombres;
            $empleado->apellidos = $apellidos;
            $empleado->created_at = date('Y-m-d H:i:s');  
            $empleado->save();

            $idEmpleado = Empleado::where('nombres',$nombres)
                        ->where('apellidos',$apellidos)->first()->id;

            $empleado = new EmpleadosProyecto();
            $empleado->idProyecto = $idProyecto;
            $empleado->idEmpleado = $idEmpleado;
            $empleado->created_at = date('Y-m-d H:i:s');  
            $empleado->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Nombres' => 'required',
            'Apellidos' => 'required',
            'Proyecto' => 'required',
        ]);

        if ($validator->passes()) {
            $nombres = $request->Nombres;
            $apellidos = $request->Apellidos;
            $idProyecto = $request->Proyecto;

            $empleado = Empleado::find($id);
            $empleado->codigo = $request->Codigo;
            $empleado->nombres = $nombres;
            $empleado->apellidos = $apellidos;
            $empleado->updated_at = date('Y-m-d H:i:s');  
            $empleado->save();

            $empleado = EmpleadosProyecto::find($id);
            $empleado->idProyecto = $idProyecto;
            $empleado->updated_at = date('Y-m-d H:i:s');  
            $empleado->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }


    public function eliminar($id)
    {
        $empleado = Proyecto::find($id)->delete();
    }

    public function info($id)
    {

        $empleado = Lead::leftJoin('users as u', 'leads.UsuarioID','=','u.id')
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

        return view('empleado.infoEmpleado',compact('empleado'));
    }




/*  finTemplate
*/






}