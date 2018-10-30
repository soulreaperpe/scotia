<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\DNPUsua;
use App\Models\Rol;
use App\Http\Requests;
use DB;
use Redirect;
use Hash;
use Crypt;
use Auth;

class UsuarioCtrl extends Controller {

    public function index(){
        return view('usuarios.index');
    }

    public function listar() {  
        $usuarios = User::leftJoin('rols', 'users.idRol', '=', 'rols.id')
            ->select('users.id','users.estado','users.name as nombre','users.email','rols.nombre as rol','users.created_at')
            ->orderBy('users.estado','desc')
            ->orderBy('users.id','desc')
            ->paginate(10);
        return view('usuarios.listar', compact('usuarios'));
    }

    public function buscar($consulta)
    {
        $usuarios = User::leftJoin('rols', 'users.idRol', '=', 'rols.id')
            ->select('users.id','users.estado','users.name as nombre','users.email','rols.nombre as rol','users.created_at')
            ->where('users.name', 'LIKE', '%'.$consulta.'%')
            ->orwhere('users.email', 'LIKE', '%'.$consulta.'%')
            ->orwhere('rols.nombre', 'LIKE', '%'.$consulta.'%')
            ->paginate(10); 
        return view('usuarios.listar', compact('usuarios'));
    }

    public function nuevo(){
        //cod_usua_sgmc
        $usuariosdnp = DNPUsua::leftJoin('SGMC_PERS', 'SGMC_USUA.COD_PERS', '=', 'SGMC_PERS.COD_PERS')
                        ->select(
                            'SGMC_USUA.COD_USUA',
                            'SGMC_PERS.ALF_NOMB',
                            'SGMC_PERS.ALF_APEL_PATE',
                            'SGMC_PERS.ALF_APEL_MATE'
                            )
                        ->where('SGMC_PERS.IND_ACTI',1)
                        ->get();
        $roles = Rol::all();
        return view('usuarios.nuevo', compact('roles','usuariosdnp'));
    }

    public function grabar(Request $request)
    {
        $cod_usua_crea = Auth::user()->id;
        $today = date('Y-m-d H:i:s');
        $usuario = new User();
        $usuario->cod_usua_sgmc = $request->cod_usua_sgmc;
        $usuario->cod_usua_crea = $cod_usua_crea;        
        $usuario->name = $request->name;
        $usuario->idRol = $request->idRol;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->created_at = $today;        
        $usuario->save();        
    }

    public function editar($id)
    {
        $usuariosdnp = DNPUsua::leftJoin('SGMC_PERS', 'SGMC_USUA.COD_PERS', '=', 'SGMC_PERS.COD_PERS')
                        ->select(
                            'SGMC_USUA.COD_USUA',
                            'SGMC_PERS.ALF_NOMB',
                            'SGMC_PERS.ALF_APEL_PATE',
                            'SGMC_PERS.ALF_APEL_MATE'
                            )
                        ->where('SGMC_PERS.IND_ACTI',1)
                        ->get();
        $usuario = User::find($id);
        $roles = Rol::all();
        return view('usuarios.editar', compact('usuario','usuariosdnp','roles'));

    } 

    public function actualizar(Request $request, $id)
    {
        $cod_usua_modi = Auth::user()->id;        
        $today = date('Y-m-d H:i:s');
        $usuario = User::find($id);
        $usuario->cod_usua_sgmc = $request->cod_usua_sgmc;        
        $usuario->cod_usua_modi = $cod_usua_modi;
        $usuario->name = $request->name;
        $usuario->idRol = $request->idRol;
        $usuario->email = $request->email;
        $usuario->estado = $request->estado; 
        $usuario->updated_at = $today;   
        $usuario->save();      
    }

    public function eliminar($id){
    	$usuario = User::find($id);
        $usuario->delete();
      	//$usuario->active = 0;
      	//$usuario->save();
        return Redirect::back()->with('message','Eliminado Satisfactorio!');
    	//return redirect(route('listdatastudent'));
    } 

}
