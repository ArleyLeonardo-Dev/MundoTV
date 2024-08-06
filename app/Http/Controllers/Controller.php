<?php

namespace App\Http\Controllers;
use App\Models\Clientes;

abstract class Controller
{
    public function llamada($body, $val){

        if($val){
            $message = [
                "message"=>"llamada correcta",
                "body"=>$body,
                "status"=>200
            ];
            return response()->json($message, 200);
        }else{
            $message = [
                "message"=>"llamada incorrecta",
                "body"=>$body,
                "status"=>200
            ];
            return response()->json($message, 400);
        }

    }

    public function verificar_cliente($data){

        #intenta buscar el nombre en la DB
        $cliente = Clientes::where("Nombre", '=', $data)->first(['*']);

        #si devuelve un arreglo vacio significa que no existe
        if($cliente == null){
            return false;
        }

        #en el caso donde no sea vacio lo devuelve y fin de la funcion
        return $cliente;
    }
}
