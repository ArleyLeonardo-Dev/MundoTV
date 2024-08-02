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

    #plantilla para ver una peticion en especifico
    public function getPeticionTemplate(request $request){
        $message = [
            "message"=>"Llamada correcta",
            "body"=>[
                "peticion"=>"requerido"
            ],
            "status"=>200
        ];

        return response()->json($message,200);
    }

    #Funcion para ver una peticion en especifico
    public function getPeticion(request $request){

        #verifica si el capo peticion esta presente en el request
        if($request->peticion == "" || $request == "[]"){
            $message = [
                "message"=>"Llamada incorrecta",
                "body"=>"El campo peticion esta vacio",
                "status"=>400
            ];

            return response()->json($message, 400);
        }

        #hace llamdo al registro con la peticion suministrada en el request
        $peticion = Peticiones::get(["*"])->where('Peticion',null, $request->peticion);

        #verifica si la peticion exise en la DB
        if ($peticion == "[]"){
            $message = [
                "message"=>"Llamada incorrecta",
                "body"=>"Esta peticion no existe",
                "status"=>400
            ];
            return response()->json($message, 400);
        }

        #cambia el aray por un objeto
        $peticion = Peticiones::find($peticion[0]->id);

        $message = [
            "message"=>"Llamada correcta",
            "body"=>$peticion,
            "status"=>200
        ];
        return response()->json($message, 200);
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
                    'Nombre'=>$request->nombre,
                    'Cedula'=>$request->cedula,
                    'Plan'=>$request->plan,
                    'serial_deco_1'=>$request->serial_deco_1,
                    'serial_tarjeta_1'=>$request->serial_tarjeta_1,
                    'serial_deco_2'=>$request->serial_deco_2,
                    'serial_tarjeta_2'=>$request->serial_tarjeta_2,
                    'serial_deco_3'=>$request->serial_deco_3,
                    'serial_tarjeta_3'=>$request->serial_tarjeta_3,
                    'serial_deco_4'=>$request->serial_deco_4,
                    'serial_tarjeta_4'=>$request->serial_tarjeta_4,
                    'serial_deco_5'=>$request->serial_deco_5,
                    'serial_tarjeta_5'=>$request->serial_tarjeta_5,
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

    #plantilla para hacer update a la tabla peticiones
    public function updatePeticionesTemplate(request $request){
        $message = [
            "message"=>"Llamada correcta",
            "body"=>[
                "body"=>[
                    "nombre"=>"si requiere",
                    "cedula"=>"si requiere",
                    "plan"=>"si requiere",
                    'serial_deco_1'=>'si requiere',
                    'serial_tarjeta_1'=>'si requiere',
                    'serial_deco_2'=>'si requiere',
                    'serial_tarjeta_2'=>'si requiere',
                    'serial_deco_3'=>'si requiere',
                    'serial_tarjeta_3'=>'si requiere',
                    'serial_deco_4'=>'si requiere',
                    'serial_tarjeta_4'=>'si requiere',
                    'serial_deco_5'=>'si requiere',
                    'serial_tarjeta_5'=>'si requiere'
                ],
                "peticion"=>"Peticion que sera actualizada"
            ],
            "status"=>200
        ];

        return response()->json($message, 200);
    }

    #funcion para actualizar todos los comapos o un solo campo de la tabla Peticiones
    public function updatePeticiones(request $request){

        #Verifica si el campo de peticiones del request esta vacio
        if ($request->peticion == ""){
            $message = [
                "message" =>"Error en la llamada",
                "body"=>"El campo peticion esta vacio",
                "status"=>400
            ];
            return response()->json($message, 400);
        }

        #hace llamado a la tabla con la peticion suministrada
        $peticion = Peticiones::get(["*"])->where("Peticion",null,$request->peticion);
        
        #si no existe la peticion suministrada mostrara el error
        if($peticion == "[]"){
            $message = [
                "message" =>"Error en la llamada",
                "body"=>"Esta Peticion no existe",
                "status"=>400
            ];
            return response()->json($message, 400);
        }

        #con el id de la peticion hace llamado otra vez a la tabla para obtener todo el array
        $peticion = Peticiones::find($peticion[0]->id);

        #reconoce si en el request esta o no esta el campo vacion o siquiera esta en el request y este mismo
        #lo actualiza
        if (isset($request->body["nombre"]) && $request->body["nombre"] != ""){
            $peticion->Nombre = $request->body["nombre"];
            $peticion->save();
        }
        if (isset($request->body["cedula"]) && $request->body["cedula"] != ""){
            $peticion->Cedula = $request->body["cedula"];
            $peticion->save();
        }
        if (isset($request->body["plan"]) && $request->body["plan"] != ""){
            $peticion->Plan = $request->body["plan"];
            $peticion->save();
        }
        if (isset($request->body["serial_deco_1"]) && $request->body["serial_deco_1"] != ""){
            $peticion->serial_deco_1 = $request->body["serial_deco_1"];
            $peticion->save();
        }
        if (isset($request->body["serial_tarjeta_1"]) && $request->body["serial_tarjeta_1"] != ""){
            $peticion->serial_tarjeta_1 = $request->body["serial_tarjeta_1"];
            $peticion->save();
        }
        if (isset($request->body["serial_deco_2"]) && $request->body["serial_deco_2"] != ""){
            $peticion->serial_deco_2 = $request->body["serial_deco_2"];
            $peticion->save();
        }
        if (isset($request->body["serial_tarjeta_2"]) && $request->body["serial_tarjeta_2"] != ""){
            $peticion->serial_tarjeta_2 = $request->body["serial_tarjeta_2"];
            $peticion->save();
        }
        if (isset($request->body["serial_deco_3"]) && $request->body["serial_deco_3"] != ""){
            $peticion->serial_deco_3 = $request->body["serial_deco_3"];
            $peticion->save();
        }
        if (isset($request->body["serial_tarjeta_3"]) && $request->body["serial_tarjeta_3"] != ""){
            $peticion->serial_tarjeta_3 = $request->body["serial_tarjeta_3"];
            $peticion->save();
        }
        if (isset($request->body["serial_deco_4"]) && $request->body["serial_deco_4"] != ""){
            $peticion->serial_deco_4 = $request->body["serial_deco_4"];
            $peticion->save();
        }
        if (isset($request->body["serial_tarjeta_4"]) && $request->body["serial_tarjeta_4"] != ""){
            $peticion->serial_tarjeta_4 = $request->body["serial_tarjeta_4"];
            $peticion->save();
        }
        if (isset($request->body["serial_deco_5"]) && $request->body["serial_deco_5"] != ""){
            $peticion->serial_deco_5 = $request->body["serial_deco_5"];
            $peticion->save();
        }
        if (isset($request->body["serial_tarjeta_5"]) && $request->body["serial_tarjeta_5"] != ""){
            $peticion->serial_tarjeta_5 = $request->body["serial_tarjeta_5"];
            $peticion->save();
        }

        $message = [
            "Message"=>"Llamada Correcta",
            "body"=>$peticion,
            "status"=>200
        ];
        return response()->json($message, 200);
    }

    #plantilla para hacer delete a la tabla peticiones
    public function deletePeticionesTemplate(request $request){
        $message = [
            "message"=>"Llamada correcta",
            "body"=>[
                "Peticion"=>"numero de la peticion que desea eliminar"
            ],
            "status"=>200
        ];
        return response()->json($message, 200);

    }

    #funcion que hace delete a un registro de las peticiones
    public function deletePeticiones(request $request){
        
        if($request->Peticion == ""){
            $message = [
                "message"=>"Llamada incorrecta",
                "body"=>"El campo Peticion esta vacio",
                "status"=>400
            ];
            return response()->json($message, 400);
        }

        $peticion = Peticiones::get(['*'])->where('Peticion',null, $request->Peticion);

        if($peticion == "[]"){
            $message = [
                "message" => "Llamda incorrecta",
                "body" => "Esta peticion no existe",
                "status" => 400
            ];
            return response()->json($message,400);
        }
        $peticion = Peticiones::find($peticion[0]->id);
        $peticion->delete();

        $message = [
            "message" => "Llamda correcta",
            "body" => "La peticion fue eliminada con exito",
            "status" => 200
        ];
        return response()->json($message,200);
    }
}   