<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Perfil;
use App\Models\PerfilPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class PerfilPermisosController extends Controller{

    public function index($id)
{
    $perfil = Perfil::find($id);
    $lista_permisos = Permiso::all();
    $permisos_asignados = PerfilPermiso::where('perfil_id', $id)->pluck('permiso_id'); // Solo IDs

    return response()->json([
        "perfil" => $perfil,
        "permisos" => $lista_permisos,
        "permisos_asignados" => $permisos_asignados, // IDs de permisos asignados
    ]);
}

    
    
    public function asignarPermisos(Request $request,)
    {
        $data = $request->all();
        if($data['id']){
            PerfilPermiso::where('perfil_id',$data['id'])->delete();

            foreach ($data['permisos'] as $permiso){
                $perfil_permiso= new PerfilPermiso();
                $perfil_permiso->perfil_id=$data['id'];
                $perfil_permiso->permiso_id=$permiso;
                $perfil_permiso->save();

            }
        }
    }




}