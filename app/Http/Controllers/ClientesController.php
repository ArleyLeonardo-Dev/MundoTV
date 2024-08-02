<?php

namespace App\Http\Controllers;
use App\Models\Clientes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

#TODOS LOS METODOS QUE TENGAN TEMPLATE AL FINAL DEL NOMBRE SON METODOS GET PARA VISUALIZAR COMO DEBE ENVIARSE #EL JSON, TODOS CONSTAN DE LA MISMA FUNCION, MOSTRAR COMO ORGANIZAR EL JSON, 

#funcion que me permite devolver los response sin necesidad de escribirlos todos de cero
function llamada($body, $validator){

    if($validator){
        $message = [
            "message"=>"Llamada Correcta",
            "body"=>$body,
            "status"=>200
        ];
        return response()->json($message, 200);
    }else{
        $message = [
            "message"=>"Llamada Incorrecta",
            "body"=>$body,
            "status"=>400
        ];
        return response()->json($message, 400);
    }
    
}

#funcion que me permite verificar si el cliente se encuentra en la DB
function verificar_cliente($cliente){
    #intenta buscar el nombre en la DB
    $cliente = Clientes::get(['*'])->where("Nombre",null, $cliente);

    #si devuelve un arreglo vacio significa que no existe
    if($cliente == "[]"){
        return llamada("Este Cliente No Existe", false);
    }

    #en el caso donde no sea vacio lo devuelve y fin de la funcion
    $cliente = Clientes::find($cliente[0]->id);
    return $cliente;
}

class ClientesController extends Controller
{
    #funcion que obtiene todos los clientes
    public function getAllClientes(request $request){

        $clientes = Clientes::all();
        return llamada($clientes, true);
    }

    public function getClienteTemplate(request $request){
        $body = [
            "Referencia"=>"si requerido",
            "Nombre"=>"si requerido",
            "Ciudad"=>"si requerido",
            "Dia_de_pago"=>"si requerido",
            "Valor_mes"=>"si requerido",
        ];

        return llamada($body, true);
    }

#funcion que obtiene a un cliente o clientes dependiendo de por que columna busque
    public function getCliente(request $request){

        if($request->all() == '[]'){
            return llamada("No se ah enviado nada", false);
        }

        if($request->Nombre != "" || isset($request->Nombre)){
            $cliente = Clientes::get(['*'])->where('Nombre',null, $request->Nombre);
            return llamada($cliente, true);
        }
        if($request->Referencia != "" || isset($request->Referencia)){
            $cliente = Clientes::get(['*'])->where('Referencia',null, $request->Referencia);
            return llamada($cliente, true);
        }
        if($request->Ciudad != "" || isset($request->Ciudad)){
            $cliente = Clientes::get(['*'])->where('Ciudad',null, $request->Ciudad);
            return llamada($cliente, true);
        }
        if($request->Dia_de_pago != "" || isset($request->Dia_de_pago)){
            $cliente = Clientes::get(['*'])->where('Dia_de_pago',null, $request->Dia_de_pago);
            return llamada($cliente, true);
        }
        if($request->Valor_mes != "" || isset($request->Valor_mes)){
            $cliente = Clientes::get(['*'])->where('Valor_mes',null, $request->Valor_mes);
            return llamada($cliente, true);
        }
    }

    public function postClienteTemplate(request $request){
        $body = [
            "Referencia"=>"requerido",
            "Nombre"=>"requerido",
            "Ciudad"=>"requerido",
            "Dia_de_pago"=>"requerido",
            "Valor_mes"=>"requerido",
        ];

        return llamada($body, true);
    }

#funcion para crear registros en la DB
    public function postCliente(request $request){
        #verifica que el request este bien
        $validacion = Validator::make($request->all(), [
            "Referencia"=>"required",
            "Nombre"=>"required",
            "Ciudad"=>"required",
            "Dia_de_pago"=>"required | integer",
            "Valor_mes"=>"required | integer"
        ]);

        #si esta mal devuelve el error
        if($validacion->fails()){
            return llamada($validacion->errors(), false);
        }else{#si no continua creando y guardando el request en la DB
            $cliente = Clientes::create([
                "Referencia"=>$request->Referencia,
                "Nombre"=>$request->Nombre,
                "Ciudad"=>$request->Ciudad,
                "Dia_de_pago"=>$request->Dia_de_pago,
                "Valor_mes"=>$request->Valor_mes
            ]);
            return llamada($cliente, 200);
        }
    }

    public function updateClienteTemplate(request $request){
        $body = [
            "Nombre_Cliente"=>"requerido",
            "Datos_a_cambiar"=>[            
                "Referencia"=>"si requiere",
                "Nombre"=>"si requiere",
                "Ciudad"=>"si requiere",
                "Dia_de_pago"=>"si requiere",
                "Valor_mes"=>"si requiere",
            ]
        ];
        return llamada($body, 200);
    }

    #funcion que actualiza los registros en la DB
    public function updateCliente(request $request){
        #guarda los datos de array "datos_a_cambiar" en data para su uso despues
        $data = $request->Datos_a_cambiar;

        #valida el request
        $validacion = Validator::make($request->all(), [
            "Nombre_Cliente"=>"required",
            "Datos_a_cambiar"=>"required"
        ]);

        #si falla devuelve el error
        if ($validacion->fails()){
            return llamada($validacion->errors(), false);
        }

        #se hace llamado a la funcion para verificar si el cliente existe en la db
        $cliente = verificar_cliente($request->Nombre_Cliente);
        
        #se verifica si existe el campo en el request y se actualiza
        if($data["Referencia"] != "" || isset($data["Referencia"]) != null){
            $cliente->Referencia = $data["Referencia"];
            $cliente->save();
            return llamada($cliente, true);
        }
        if($data["Nombre"] != "" || isset($data["Nombre"]) != null){
            $cliente->Nombre = $data["Nombre"];
            $cliente->save();
            return llamada($cliente, true);
        }
        if($data["Ciudad"] != "" || isset($data["Ciudad"]) != null){
            $cliente->Ciudad = $data["Ciudad"];
            $cliente->save();
            return llamada($cliente, true);
        }
        if($data["Dia_de_pago"] != "" || isset($data["Dia_de_pago"]) != null){
            $cliente->Dia_de_pago = $data["Dia_de_pago"];
            $cliente->save();
            return llamada($cliente, true);
        }
        if($data["Valor_mes"] != "" || isset($data["Valor_mes"]) != null){
            $cliente->Valor_mes = $data["Valor_mes"];
            $cliente->save();
            return llamada($cliente, true);
        }
    }

    public function deleteClienteTemplate(request $request){
        $body = [
            "Cliente" => "requerido"
        ];
        return llamada($body, true);
    }

    #funcion para borrar un registro de la DB
    public function deleteCliente(request $request){
        #valida que el request este correcto
        $validacion = Validator::make($request->all(),[
            "Cliente"=>"required"
        ]);

        #devuelve el error si el request no esta correcto
        if($validacion->fails()){
            return llamada($validacion->errors(), false);
        }

        #verifica si el cliente existe en la DB
        $cliente = verificar_cliente($request->Cliente);
        $cliente->delete();#elimina y devuelve la confirmacion
        return llamada("Cliente eliminado", 200);
    }

}
