<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\PerfilPermisosController;
use App\Http\Controllers\PeriodoPromocionController;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get(
    "/Usuarios",
    [
        LoginController::class,
        "getApiUsuario"
    ]
);

// Ruta para eliminar un formulario por su ID
Route::delete(
    "/delete_Usuario/{id}",
    [
        LoginController::class,
        "deleteApiUsuario"
    ]
);

Route::post(
    "/submit_login",
    [
        LoginController::class,
        "postApiAddUsuario"
    ]
);
Route::post(
    "/inicio_de_sesion",
    [
        LoginController::class,
        "postApiVerificacion"
    ]
);

Route::put(
    "update_login/{id}",
    [
        LoginController::class,
    "putApiUpdateLogin"
    ]
);

Route::get(
    "/get_Usuario/{id}",
    [
        LoginController::class,
        "getApiGetUsuarioByID"
    ]
);


// Ruta para obtener el listado de formularios
Route::get(
    "/formularios",
    [
        FormularioController::class,
        "getApiListado"
    ]
);

// Ruta para obtener un formulario por su ID
Route::get(
    "/get_formulario/{id}",
    [
        FormularioController::class,
        "getApiGetFormularioByID"
    ]
);

// Ruta para eliminar un formulario por su ID
Route::delete(
    "/delete_formulario/{id}",
    [
        FormularioController::class,
        "deleteApiEliminar"
    ]
);

Route::post(
    "/submit_formulario",
    [
        FormularioController::class,
        "postApiAddFormulario"
    ]
);

Route::put(
    "update_formulario/{id}",
    [
        FormularioController::class,
    "putApiUpdateFormulario"
    ]
);


Route::post(
    "search_producto",
[
    FormularioController::class,
    "getApiFiltro"
]);




//---------------listado_compras--------
Route::get(
    "/compras/{id}",
    [
        ComprasController::class,
        "getApiListado_Compras"
    ]
);

Route::get(
    "/get_compra/{id}",
    [
        ComprasController::class,
        "getApiGetComprasByID"
    ]
);

Route::delete(
    "/delete_compra/{id}",
    [
        ComprasController::class,
        "deleteApiEliminar_Compras"
    ]
);


Route::post(
    "/comprass",
   [
    ComprasController::class,
       "postApiAddCompras"
    ]);


    Route::put(
        "update_compra/{id}",
        [
            ComprasController::class,
        "putApiUpdateCompras"
        ]
    );



//--------------------------------perfiles--------------------

Route::post("/submit_perfil", [PerfilController::class, "postApiAddPerfil"]);
Route::put("update_perfil/{id}", [PerfilController::class, "putApiUpdatePerfil"]);
Route::get("/get_Perfil/{id}", [PerfilController::class, "getApiGetPerfilByID"]);
Route::get("/Perfiles", [PerfilController::class, "getApiPerfil"]);
Route::delete("/delete_Perfil/{id}", [PerfilController::class, "deleteApiPerfil"]);




//------------------------------REGISTRO DE PERMISOS--------------------------------

Route::post("/submit_permiso", [RegistroController::class, "postApiAddPermiso"]);
Route::put("update_permiso/{id}", [RegistroController::class, "putApiUpdatePermiso"]);
Route::get("/Permisos", [RegistroController::class, "getApiPermiso"]);
Route::delete("/delete_Permiso/{id}", [RegistroController::class, "deleteApiPermiso"]);
Route::get("/get_permiso/{id}", [RegistroController::class, "getApiGetPermisoByID"]);




//------------------------------PerfilPermisos-----------------------------------------
Route::get('/perfil-permisos/{id}', [PerfilPermisosController::class, 'index']);
Route::put('cambios-permisos/{id}', [PerfilPermisosController::class, 'asignarPermisos']);

//------------------------------promociones-------------------------------------




Route::get('fecha', [PeriodoPromocionController::class, 'index']);
Route::get('/promociones', [PeriodoPromocionController::class, 'obtenerperiodopromocion']);








//unity ruta

Route::get('/ultima_compra/{id_usuario}', [ComprasController::class, 'getApiUltimaCompra']);


Route::get('/compras/{id_usuario}', [ComprasController::class, 'getApiListadoCompras_todo']);







