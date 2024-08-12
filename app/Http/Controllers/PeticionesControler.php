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

        return Controller::llamada($peticiones, true);
    }

    #plantilla para ver una peticion en especifico
    public function getPeticionTemplate(request $request){
        $message = [
            "peticion"=>"requerido"
        ];

        return Controller::llamada($message, true);
    }

    #Funcion para ver una peticion en especifico
    public function getPeticion(request $request){

        $validacion = Validator::make($request->all(), [
            "peticion"=>"required"
        ]);

        #verifica si el capo peticion esta presente en el request
        if($validacion->fails()){
            return Controller::llamada($validacion->errors(), true);
        }

        #hace llamdo al registro con la peticion suministrada en el request
        $peticion = Peticiones::where('peticion',"=", $request->peticion)->first(['*']);

        if($peticion == null){
            return Controller::llamada("Esta peticion no existe", false);
        }else{
            return Controller::llamada($peticion, true);
        }  
    }

    #funcion para ver la plantilla de como hacer el post a Peticiones
    public function postPeticionesTemplate(request $request){
        $message = [
            'peticion'=>'required',
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
        ];

        return Controller::llamada($message, true);
    }

    #funcion para hacer post a peticiones
    public function postPeticiones(request $request){

        #validacion de que todos los datos fueron enviados correctamente
        $validation = Validator::make($request->all(),[
            'peticion'=>'required',
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
            return Controller::llamada($validation->errors(), false);
        #si no hubo ningun error se guardara el resgistro en la base de datos
        }else{
            
            #identifica si el registro que se va a guardar ya existe en la DB
            try{
                $creacionPeticion = Peticiones::create([
                    'peticion'=>$request->peticion,
                    'nombre'=>$request->nombre,
                    'cedula'=>$request->cedula,
                    'plan'=>$request->plan,
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
                return Controller::llamada($creacionPeticion, true);
                    
            #Esto se ejecuta si ya el registro existe en la DB       
            } catch(\Exception $e) {
                return Controller::llamada($e->getMessage(), false);
            }
        }
    }

    #plantilla para hacer update a la tabla peticiones
    public function updatePeticionesTemplate(request $request){
        $message = [
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
        ];

        return Controller::llamada($message, true);
    }

    #funcion para actualizar todos los comapos o un solo campo de la tabla Peticiones
    public function updatePeticiones(request $request){
        $validation = Validator::make($request->all(), [
            "peticion"=>"required"
        ]);
        #Verifica si el campo de peticiones del request esta vacio
        if ($validation->fails()){
            return Controller::llamada($validation, false);
        }

        #hace llamado a la tabla con la peticion suministrada
        $peticion = Peticiones::where("peticion",'=',$request->peticion)->first(['*']);
        
        #si no existe la peticion suministrada mostrara el error
        if($peticion == null){
            return Controller::llamada("Esta peticion no existe", false);
        }
        $lista = ["nombre","cedula","plan",'serial_deco_1','serial_tarjeta_1','serial_deco_2','serial_tarjeta_2','serial_deco_3','serial_tarjeta_3','serial_deco_4','serial_tarjeta_4','serial_deco_5','serial_tarjeta_5'];

        #reconoce si en el request esta o no esta el campo vacion o siquiera esta en el request y este mismo
        #lo actualiza
        foreach($lista as $x){
            if (isset($request->body[$x]) && $request->body[$x] != ""){
                $peticion->$x = $request->body[$x];
                $peticion->save();
            }else{
                continue;
            }
        }
        return Controller::llamada($peticion, true);
    }

    #plantilla para hacer delete a la tabla peticiones
    public function deletePeticionesTemplate(request $request){
        $message =["peticion"=>"numero de la peticion que desea eliminar"];
        return Controller::llamada($message, true);
    }

    #funcion que hace delete a un registro de las peticiones
    public function deletePeticiones(request $request){
        $validacion = Validator::make($request->all(),[
            'peticion'=>"required"
        ]);

        if($validacion->fails()){
            return Controller::llamada($validacion->errors(), false);
        }

        $peticion = Peticiones::where('peticion','=', $request->peticion)->first(['*']);

        if($peticion == null){
            return Controller::llamada("Esta peticion no existe", false);
        }
        $peticion->delete();

        return Controller::llamada('La peticion fue eliminada con exito', true);
    }
}   