<?php

namespace App\Http\Controllers;
use App\Models\Clientes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

#TODOS LOS METODOS QUE TENGAN TEMPLATE AL FINAL DEL NOMBRE SON METODOS GET PARA VISUALIZAR COMO DEBE ENVIARSE #EL JSON, TODOS CONSTAN DE LA MISMA FUNCION, MOSTRAR COMO ORGANIZAR EL JSON

class ClientesController extends Controller
{
    #funcion que obtiene todos los clientes
    public function getAllClientes(request $request){

        $clientes = Clientes::all();
        return Controller::llamada($clientes, true);
    }

    public function getClienteTemplate(request $request){
        $body = [
            "Referencia"=>"si requerido",
            "Nombre"=>"si requerido",
            "Ciudad"=>"si requerido",
            "Dia_de_pago"=>"si requerido",
            "Valor_mes"=>"si requerido",
        ];

        return Controller::llamada($body, true);
    }

#funcion que obtiene a un cliente o clientes dependiendo de por que columna busque
    public function getCliente(request $request){

        if($request->all() == '[]'){
            return Controller::llamada("No se ah enviado nada", false);
        }

        if($request->Nombre != "" || isset($request->Nombre)){
            $cliente = Clientes::get(['*'])->where('Nombre',null, $request->Nombre);
            return Controller::llamada($cliente, true);
        }
        if($request->Referencia != "" || isset($request->Referencia)){
            $cliente = Clientes::get(['*'])->where('Referencia',null, $request->Referencia);
            return Controller::llamada($cliente, true);
        }
        if($request->Ciudad != "" || isset($request->Ciudad)){
            $cliente = Clientes::get(['*'])->where('Ciudad',null, $request->Ciudad);
            return Controller::llamada($cliente, true);
        }
        if($request->Dia_de_pago != "" || isset($request->Dia_de_pago)){
            $cliente = Clientes::get(['*'])->where('Dia_de_pago',null, $request->Dia_de_pago);
            return Controller::llamada($cliente, true);
        }
        if($request->Valor_mes != "" || isset($request->Valor_mes)){
            $cliente = Clientes::get(['*'])->where('Valor_mes',null, $request->Valor_mes);
            return Controller::llamada($cliente, true);
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

        return Controller::llamada($body, true);
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
            return Controller::llamada($validacion->errors(), false);
        }else{#si no continua creando y guardando el request en la DB
            $cliente = Clientes::create([
                "Referencia"=>$request->Referencia,
                "Nombre"=>$request->Nombre,
                "Ciudad"=>$request->Ciudad,
                "Dia_de_pago"=>$request->Dia_de_pago,
                "Valor_mes"=>$request->Valor_mes
            ]);
            return Controller::llamada($cliente, 200);
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
        return Controller::llamada($body, 200);
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
            return Controller::llamada($validacion->errors(), false);
        }

        #se hace llamado a la funcion para verificar si el cliente existe en la db
        $cliente = Controller::verificar_cliente($request->Nombre_Cliente);
        if($cliente == false){
            return Controller::llamada("Este usuario no existe", false);
        }
        
        #se verifica si existe el campo en el request y se actualiza
        if(isset($data["Referencia"])){
            $cliente->Referencia = $data["Referencia"];
            $cliente->save();
            return Controller::llamada($cliente, true);
        }
        if(isset($data["Nombre"])){
            $cliente->Nombre = $data["Nombre"];
            $cliente->save();
            return Controller::llamada($cliente, true);
        }
        if(isset($data["Ciudad"])){
            $cliente->Ciudad = $data["Ciudad"];
            $cliente->save();
            return Controller::llamada($cliente, true);
        }
        if(isset($data["Dia_de_pago"])){
            $cliente->Dia_de_pago = $data["Dia_de_pago"];
            $cliente->save();
            return Controller::llamada($cliente, true);
        }
        if(isset($data["Valor_mes"])){
            $cliente->Valor_mes = $data["Valor_mes"];
            $cliente->save();
            return Controller::llamada($cliente, true);
        }
    }

    public function deleteClienteTemplate(request $request){
        $body = [
            "Cliente" => "requerido"
        ];
        return Controller::llamada($body, true);
    }

    #funcion para borrar un registro de la DB
    public function deleteCliente(request $request){
        #valida que el request este correcto
        $validacion = Validator::make($request->all(),[
            "Cliente"=>"required"
        ]);

        #devuelve el error si el request no esta correcto
        if($validacion->fails()){
            return Controller::llamada($validacion->errors(), false);
        }

        #verifica si el cliente existe en la DB
        $cliente = Controller::verificar_cliente($request->Cliente);
        if($cliente == false){
            return Controller::llamada("Este usuario no existe", false);
        }
        
        $cliente->delete();#elimina y devuelve la confirmacion
        return Controller::llamada("Cliente eliminado", 200);
    }

}
