<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Compras;
use App\Models\Formulario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComprasController extends Controller{

    public function getApiListado_Compras($id = null) {
        $compras = Compras::Where('id_usuario',$id)->get(); // Obtiene todas las compras
        return response()->json($compras); // Devuelve un JSON
    }

    // Agregamos un parámetro
public function getApiGetComprasByID($id = null) {
    // Ejecutamos el método find para buscar por el pk
    // "SELECT * FROM compras WHERE id=3"
    $compras = Compras::find($id);
      // Verificamos si el registro existe
      if (!$compras) {
        // Devolver un error 404 si no se encuentra el registro
        return response()->json(['error' => 'Compra no encontrada'], 404);
    }

    // Devolver el registro en formato JSON
    return response()->json($compras);
}


public function deleteApiEliminar_Compras($id) { 
    // Se busca el registro de la tabla
    // "SELECT * FROM compras WHERE id=1"
    $compras = Compras::find($id);

    // Se borra la imagen
    if (!empty($compras->imagen)) {
        Storage::delete(public_path('imagenes_compras').'/'.$compras->imagen);
    }

    // Se ejecuta el método delete
    // "DELETE FROM compras WHERE id=1"
    $compras->delete();
}




public function putApiUpdateCompras($id, Request $request) { 
    // Obtenemos los parámetros de la petición
    $data = $request->all();
    $ruta_archivo_original = null;

    // Se busca el registro con el id
    $compras = Compras::find($id);

    // Validamos si la imagen se está enviando
    if ($request->hasFile('imagen')) {
        // Validamos si hay una imagen en la base de datos
        if ($compras->imagen != null) {
            // Eliminar la imagen que se tiene en la base de datos
            Storage::delete(public_path('imagenes_compras').'/'.$compras->imagen);
        }
        // Generamos un nombre aleatorio y concatenamos la extensión de la imagen
        $nombreImagen = time().'.'.$request->imagen->extension();
        // Movemos el archivo a la carpeta pública con el nombre
        $request->imagen->move(public_path('imagenes_compras'), $nombreImagen);
        // Asignamos el nombre del archivo
        $ruta_archivo_original = $nombreImagen;
    }

    // Se asignan los parámetros de la petición al objeto
    $compras->nombre = $data['nombre'];
    $compras->descripcion = $data['descripcion'];
    $compras->precio = $data['precio'];
    $compras->precio = $data['fecha'];

    if ($request->hasFile('imagen')) {
        $compras->imagen = $ruta_archivo_original;
    }

    // Se ejecuta el método save para agregar o modificar el registro
    $compras->save();
}



    public function postApiAddCompras(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        $producto_id = $data['id'];
        $usuario_id = $data['id_usuario'];
        $formulario = Formulario::find($producto_id);

        // Instanciamos un objeto compras
        $compras = new Compras();
        
    
        $compras->nombre = $formulario->nombre;
        $compras->descripcion = $formulario->descripcion;
        $compras->precio = $formulario->precio;
        $compras->fecha = now();
        $compras->imagen = $formulario->imagen;

        //nuevo lo acabo de agregar
        $compras->id_usuario = $usuario_id;
        

    
        // Se ejecuta el método save para agregar o modificar el registro

        $compras->save();
        
    }

//nuevo metodo para unity--------------------------------------------------------------------
public function getApiUltimaCompra($id_usuario) {
    $ultimaCompra = Compras::where('id_usuario', $id_usuario)->first(); // Solo obtiene la primera compra del usuario

    if ($ultimaCompra) {
        return response()->json([
            'success' => true,
            'id' => $ultimaCompra->id,
            'nombre' => $ultimaCompra->nombre,
            'descripcion' => $ultimaCompra->descripcion,
            'precio' => $ultimaCompra->precio,
            'fecha' => $ultimaCompra->fecha,
            'imagen' => url('imagenes_compras/' . $ultimaCompra->imagen)
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'No hay compras recientes.'
    ]);
}


//nuevo compras 

public function getApiListadoCompras_todo($id_usuario)
{
    $compras = Compras::where('id_usuario', $id_usuario)->get();

    return response()->json([
        'success' => true,
        'compras' => $compras->map(function ($compra) {
            return [
                'id_producto' => $compra->id, // Renombramos 'id' a 'id_producto'
                'nombre' => $compra->nombre,
                'descripcion' => $compra->descripcion,
                'precio' => $compra->precio,
                'imagen' => $compra->imagen,
                'fecha' => $compra->fecha,
                'id_usuario' => $compra->id_usuario
            ];
        })
    ]);
}


    
    


}


