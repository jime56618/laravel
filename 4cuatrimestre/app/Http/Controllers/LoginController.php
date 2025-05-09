<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller{


    public function getApiUsuario() {
        // Se usa el método all para obtener todos los formularios
        // "SELECT * FROM formularios"
        $login = Login::all();
        return ["login" => $login];
    }

    public function getApiGetUsuarioByID($id = null) {
        // Ejecutamos el método find para buscar por el pk
        // "SELECT * FROM formularios WHERE id=3"
        $login = Login::find($id);
        return $login;
    }

    public function deleteApiUsuario($id) {
        // Se busca el registro de la tabla
        // "SELECT * FROM formularios WHERE id=1"
        $login = Login::find($id);
        // Se ejecuta el método delete
        // "DELETE FROM formularios WHERE id=1"
        $login->delete();
    }

    public function postApiAddUsuario(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();

        $perfil = Perfil::firstOrCreate(['nombre_perfil' => $data['funcion']]);
        
        
        // Establecemos un nombre para la imagen
        // Instanciamos un objeto formulario
        $login = new Login();
        // Se asignan los parámetros de la petición al objeto
        $login->nombre = $data['nombre'];
        //$login->email = $data['email'];
        $login->password = Hash::make($data['password']);
        //se busca la funcion
        $login->funcion = $perfil->idperfil;
        //$login->funcion = $perfil->nombre_perfil;
        //$login->funcion = $data['funcion'];
        // Se ejecuta el método save para agregar o modificar el registro
        $login->save();
        return response()->json(['message' => 'Usuario guardado con éxito', 'id' => $login->id], 201);
    }


    public function putApiUpdateLogin($id, Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        // Se busca el registro con el id
        $login = Login::find($id);
    
        // Se asignan los parámetros de la petición al objeto
        $login->nombre = $data['nombre'];
        //$login->email = $data['email'];
        $login->password = Hash::make($data['password']);

        //error aqui
        $perfil = Perfil::firstOrCreate(['nombre_perfil' => $data['funcion']]);
         $login->funcion = $perfil->idperfil;
        //$login->funcion = $data['funcion'];
        // Se ejecuta el método save para agregar o modificar el registro
        $login->save();

        return response()->json(['message' => 'Usuario actualizado con éxito', 'id' => $login->id], 200);
    }



    public function postApiVerificacion(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();

        $nombre = $data['nombre'];
        $password = $data['password'];
        

        // Busca al usuario por nombre
        $usuario_existe = Login::where('nombre', $nombre)->first();

        // Verifica que el usuario exista y que la contraseña coincida
        if ($usuario_existe && Hash::check($password, $usuario_existe->password)) {

            //$perfil = Perfil::find($usuario_existe->funcion);
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'id' => $usuario_existe->id,
                'nombre' => $usuario_existe->nombre,
                'rol' => $usuario_existe->perfil ? $usuario_existe->perfil->idperfil : 'Sin perfil',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Usuario o contraseña incorrectos'
            ], 401);
        }
    }
      

}






