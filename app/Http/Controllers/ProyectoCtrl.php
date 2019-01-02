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
            ->orderBy('created_at','desc')
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
        
        return view('proyecto.nuevo');
    }

    public function editar($id)
    {
        $proyecto = Proyecto::find($id);
        return view('proyecto.editar', compact('proyecto'));
    }

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Proyecto' => 'required',
            'Inicio' => 'required',
        ]);

        if ($validator->passes()) {
            $inicio = Carbon::createFromFormat('d-m-Y',$request->Inicio);
            $fin = Carbon::createFromFormat('d-m-Y',$request->Fin);

            $proyecto = new Proyecto();
            $proyecto->nombre = $request->Proyecto;
            $proyecto->inicio = $inicio;
            $proyecto->fin = $fin;
            $proyecto->descripcion = $request->Descripcion;
            $proyecto->created_at = date('Y-m-d H:i:s');  
            $proyecto->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Proyecto' => 'required',
            'Inicio' => 'required',
        ]);

        if ($validator->passes()) {
            $inicio = Carbon::createFromFormat('d-m-Y',$request->Inicio);
            $fin = Carbon::createFromFormat('d-m-Y',$request->Fin);

            $proyecto = Proyecto::find($id);
            $proyecto->nombre = $request->Proyecto;
            $proyecto->inicio = $inicio;
            $proyecto->fin = $fin;
            $proyecto->descripcion = $request->Descripcion;
            $proyecto->updated_at = date('Y-m-d H:i:s'); 
            $proyecto->save();

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