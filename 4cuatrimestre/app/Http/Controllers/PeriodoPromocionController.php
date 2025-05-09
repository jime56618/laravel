<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\PeriodoPromocion;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Carbon;



class PeriodoPromocionController extends Controller{
    public function postApiAddpromocion(Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
        // Instanciamos un objeto formulario
        $promocion = new PeriodoPromocion();

        // Se asignan los parámetros de la petición al objeto
        $promocion->nombre_promocion = $data['promocion'];
        $promocion->porcentaje_descuento = $data['descuento'];
        $promocion->fecha_inicio = $data['fecha_inicio'];
        $promocion->fecha_fin = $data['fecha_fin'];

        // Se ejecuta el método save para agregar o modificar el registro
        $promocion->save();
    }
        

    public function putApiUpdatePromocion($id, Request $request) {
        // Obtenemos los parámetros de la petición
        $data = $request->all();
    
        // Se busca el registro con el id
        $promocion = PeriodoPromocion::find($id);
    
    
        // Se asignan los parámetros de la petición al objeto
        $promocion->nombre_promocion = $data['promocion'];
        $promocion->porcentaje_descuento = $data['descuento'];
        $promocion->fecha_inicio = $data['fecha_inicio'];
        $promocion->fecha_fin = $data['fecha_fin'];

        // Se ejecuta el método save para agregar o modificar el registro
        $promocion->save();
    }


    public function getApiGetPromocionByID($id = null) {
        // Ejecutamos el método find para buscar por el pk
        // "SELECT * FROM formularios WHERE id=3"
        $promocion = PeriodoPromocion::find($id);
        return $promocion;
    }


    public function getApiPromocion() {
        // Se usa el método all para obtener todos los formularios
        // "SELECT * FROM formularios"
        $promocion = PeriodoPromocion::all();
        return ["promocion" => $promocion];
    }


    public function deleteApiPerfil($id) {
        // Se busca el registro de la tabla
        // "SELECT * FROM formularios WHERE id=1"
        $promocion = PeriodoPromocion::find($id);
        // Se ejecuta el método delete
        // "DELETE FROM formularios WHERE id=1"
        $promocion->delete();
    }

    public function index(){

        //Tae la fecha actual
        $fecha_inicio=Carbon::now();

        //trae la fecha actual y hora actual +2 segundos
        $fecha_fin= Carbon::now()->addMinutes(10);

        $periodo= new PeriodoPromocion();
        $periodo->nombre_promocion="Black friday";
        $periodo->porcentaje_descuento=50;
        $periodo->fecha_inicio= $fecha_inicio;
        $periodo->fecha_fin= $fecha_fin;
        $periodo->save();
        


        return[
            'fecha_inicio'=>$fecha_inicio->subHours(6),
            'fecha_fin'=>$fecha_fin->subHours(6)
        ];

    }


    public function obtenerperiodopromocion(){
        $fecha_hoy=Carbon::now();

        $promocion = PeriodoPromocion::where('fecha_inicio','<=', $fecha_hoy)->where('fecha_fin','>=', $fecha_hoy )->first();

        if($promocion !=null){
            return[
                "error"=>false,
                "message"=>"Existe una promocion" . $promocion->nombre_promocion,
                "data" =>[
                    "descuento" =>$promocion->porcentaje_descuento
                ]
                ];
        }

        return[
            "error"=>true,
            "message" =>"no existe una promocion"
        ];
    }

}