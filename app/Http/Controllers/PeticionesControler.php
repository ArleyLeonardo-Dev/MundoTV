<?php

namespace App\Http\Controllers;

use App\Models\Peticiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeticionesControler extends Controller
{
    #Funcion para ver todas las peticiones
    public function getPeticiones(request $request){
        $peticiones = Peticiones::all();

        $message = [
            "messaje"=>"llamada correcta",
            "body"=>$peticiones,
            "status"=>200
        ];
        return response()->json($message,200);
    }

    #funcion para ver la plantilla de como hacer el post a Peticiones
    public function postPeticionesTemplate(request $request){
        $message = [
            "message"=>"llamada correcta",
            "body"=>[
                'Peticion'=>'',
                'nombre'=>'',
                'cedula'=>'',
                'plan'=>'',
                'serial_deco_1'=>'',
                'serial_tarjeta_1'=>'',
                'serial_deco_2'=>'',
                'serial_tarjeta_2'=>'',
                'serial_deco_3'=>'',
                'serial_tarjeta_3'=>'',
                'serial_deco_4'=>'',
                'serial_tarjeta_4'=>'',
                'serial_deco_5'=>'',
                'serial_tarjeta_5'=>''
            ],
            "status"=>200
        ];

        return response()->json($message,200);
    }

    #funcion para hacer post a peticiones
    public function postPeticiones(request $request){

        #validacion de que todos los datos fueron enviados correctamente
        $validation = Validator::make($request->all(),[
            'Peticion'=>'required',
            'nombre'=>'required',
            'cedula'=>'required',
            'plan'=>'required',
            'serial_deco_1'=>'required',
            'serial_tarjeta_1'=>'required',
            'serial_deco_2'=>'required',
            'serial_tarjeta_2'=>'required',
            'serial_deco_3'=>'required',
            'serial_tarjeta_3'=>'required',
            'serial_deco_4'=>'required',
            'serial_tarjeta_4'=>'required',
            'serial_deco_5'=>'required',
            'serial_tarjeta_5'=>'required'
        ]);

        #errores que puede mandar la validacion
        if($validation->fails()){
            $message = [
                "message"=>"Error",
                "body"=>$validation->errors(),
                "status"=>400
            ];
            return response()->json($message,400);
        #si no hubo ningun error se guardara el resgistro en la base de datos
        }else{
            
            #identifica si el registro que se va a guardar ya existe en la DB
            try{
                $creacionPeticion = Peticiones::create([
                    'Peticion'=>$request->Peticion,
                    'nombre'=>$request->nombre,
                    'cedula'=>$request->cedula,
                    'plan'=>$request->plan,
                    'serial deco 1'=>$request->serial_deco_1,
                    'serial tarjeta 1'=>$request->serial_tarjeta_1,
                    'serial deco 2'=>$request->serial_deco_2,
                    'serial tarjeta 2'=>$request->serial_tarjeta_2,
                    'serial deco 3'=>$request->serial_deco_3,
                    'serial tarjeta 3'=>$request->serial_tarjeta_3,
                    'serial deco 4'=>$request->serial_deco_4,
                    'serial tarjeta 4'=>$request->serial_tarjeta_4,
                    'serial deco 5'=>$request->serial_deco_5,
                    'serial tarjeta 5'=>$request->serial_tarjeta_5,
                ]);
            
                $message = [
                    "message"=>"llamada correcta",
                    "body"=>$creacionPeticion,
                    "status"=>200
                ];
                return response()->json($message,200);
                    
            #Esto se ejecuta si ya el registro existe en la DB       
            } catch(\Exception $e) {
                $message = [
                    "message"=>"llamada incorrecta",
                    "body"=>$e->getMessage(),
                    "status"=>400
                ];
                return response()->json($message,400);
            }
        }
    }
}

