<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Permiso;
use App\Models\PerfilPermiso;
use Illuminate\Http\Request;

class PerfilController extends Controller{
 
    public function postApiAddPerfil(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        // Instanciamos un objeto formulario
        $perfil = new Perfil();

        // Se asignan los parámetros de la petición al objeto
        $perfil->nombre_perfil = $data['perfiles'];
        // Se ejecuta el método save para agregar o modificar el registro
        $perfil->save();
    }
        

    public function putApiUpdatePerfil($id, Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
    
        // Se busca el registro con el id
        $perfil = Perfil::find($id);
    
    
        // Se asignan los parámetros de la petición al objeto
        $perfil->nombre_perfil = $data['perfiles'];

        // Se ejecuta el método save para agregar o modificar el registro
        $perfil->save();
    }


    public function getApiGetPerfilByID($id = null) {
        // Ejecutamos el método find para buscar por el pk
        // "SELECT * FROM formularios WHERE id=3"
        $perfil = Perfil::find($id);
        return $perfil;
    }


    public function getApiPerfil() {
        // Se usa el método all para obtener todos los formularios
        // "SELECT * FROM formularios"
        $perfil = Perfil::all();
        return ["perfiles" => $perfil];
    }


    public function deleteApiPerfil($id) {
        // Se busca el registro de la tabla
        // "SELECT * FROM formularios WHERE id=1"
        $perfil = Perfil::find($id);
        // Se ejecuta el método delete
        // "DELETE FROM formularios WHERE id=1"
        $perfil->delete();
    }

}