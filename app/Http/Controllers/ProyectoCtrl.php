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

/*  inicioTemplate
*/


    
    public function buscar($consulta)
    {
        $proyectos = DB::table('proyectos')
            ->where('nombre', 'LIKE', '%'.$consulta.'%')
            ->orwhere('descripcion', 'LIKE', '%'.$consulta.'%')
            ->orwhere('inicio', 'LIKE', '%'.$consulta.'%')
            ->orwhere('fin', 'LIKE', '%'.$consulta.'%')
            ->orderBy('created_at','desc')
            ->paginate(10);
        return view('proyecto.listar', compact('proyectos'));
    }

    public function nuevo()
    {
        $usuarios = User::where('idRol','<=','3')->where('estado',1)->get();
        return view('proyecto.nuevo',compact('usuarios'));
    }

    public function editar($id)
    {
        $lead = Lead::find($id);
        $usuarios = User::where('idRol','<=','3')->where('estado',1)->get();
        return view('Leads.editar', compact('lead','usuarios'));
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
            $lead = new Lead();
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