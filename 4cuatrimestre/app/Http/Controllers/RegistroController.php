<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use App\Models\PerfilPermiso;
use App\Models\Perfil;

class RegistroController extends Controller{
    public function postApiAddPermiso(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        // Instanciamos un objeto formulario
        $permiso = new Permiso();
        // Se asignan los parámetros de la petición al objeto
        $permiso->nombre = $data['permisos'];
        $permiso->clave = $data['clave'];
        // Se ejecuta el método save para agregar o modificar el registro
        $permiso->save();
    }
    

    public function putApiUpdatePermiso($id, Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        // Se busca el registro con el id
        $permiso = Permiso::find($id);
        // Se asignan los parámetros de la petición al objeto
        $permiso->nombre = $data['permisos'];
        $permiso->clave = $data['clave'];
        // Se ejecuta el método save para agregar o modificar el registro
        $permiso->save();
    }



    public function getApiPermiso() {
        // Se usa el método all para obtener todos los formularios
        // "SELECT * FROM formularios"
        $permiso = Permiso::all();
        return ["permiso" => $permiso];
    }
    
    public function getApiGetPermisoByID($id = null) {
        // Ejecutamos el método find para buscar por el pk
        // "SELECT * FROM formularios WHERE id=3"
        $permiso = Permiso::find($id);
        return $permiso;
    }


    public function deleteApiPermiso($id) {
        // Se busca el registro de la tabla
        // "SELECT * FROM formularios WHERE id=1"
        $permiso = Permiso::find($id);
        // Se ejecuta el método delete
        // "DELETE FROM formularios WHERE id=1"
        $permiso->delete();
    }

}