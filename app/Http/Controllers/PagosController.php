<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Pagos;
use App\Models\Clientes;

class PagosController extends Controller

{
    #metodo get al endpoint Pagos
    public function postPagosTemplate(request $request){
        $message = [
            "Cliente"=>"requerido",
            "Mes"=>"requerido",
            "Pago"=>"true or false (llenar Pago o Abono)",
            "Abono"=>"Precio en pesos o false si no requiere (llenar Pago o Abono)"
        ];

        return Controller::llamada($message, true);
    }

    #metodo post al endpoint Pagos
    public function postPagos(request $request){
        #lista de los meses para comparacion con lo indexado en el request
        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

        #valida si el request tiene los datos requeridos
        $validacion = Validator::make($request->all(), [
            "Cliente"=>"required",
            "Mes"=>"required",
            "Pago"=>"required",
            "Abono"=>"required"
        ]);

        #verifica y manda error si los datos no estan bien indexados
        if ($validacion->fails()){
            return Controller::llamada($validacion->errors(),false);
        }

        #verifica y lanza error si el usuario no existe en la DB
        $cliente = Controller::verificar_cliente($request->Cliente);
        if($cliente == false){
            return Controller::llamada("Este usuario no existe", false);
        }

        #Recoje el mes indexado lo transforma para parecer al de la DB, si en el request se anota que pago se ejecuta este if
        $mes = ucfirst(strtolower($request->Mes));
        if($request->Pago == true){
            #verifica si el mes indexado es valido
            if(!in_array($mes, $meses)){
                return Controller::llamada("Insertar Mes Valido", false);
            }else{
                #asignamos "pago" al campo del mes de la DB
                $cliente->$mes = "Pago";
                #obtenemos el indice de 4 meses atras para borrarlo ya que no ya no se ocupa y asi no generar un tabal nueva cada año
                $indice = array_search($mes, $meses) - 4;
                #si el idice es negativo se hace una operacion matemarica para que siga en el rango de los indices de los 12 meses osea 1 - 11
                if ($indice < 0){
                    $indice = ($indice + 1) + 11;
                    $mesABorrar = $meses[$indice];
                    $cliente->$mesABorrar = null;
                    $cliente->save();
                    #guarda un registro del pago, a nombre de quien, el mes y si pago o abono ademas del tiempo exacto cuando se hizo el pago
                    $pago = Pagos::create([
                        "Cliente"=>$request->Cliente,
                        "Mes"=>$mes,
                        "Pago_Abono"=>"Pago"
                    ]);
                    return Controller::llamada($pago, true);
                #si el indice no es negativo simplemente borra el registro de el mes anterior a 4 meses
                }else{
                    $mesABorrar = $meses[$indice];
                    $cliente->$mesABorrar = null;
                    $cliente->save();
                    $pago = Pagos::create([
                        "Cliente"=>$request->Cliente,
                        "Mes"=>$mes,
                        "Pago_Abono"=>"Pago"
                    ]);
                    return Controller::llamada($pago, true);
                }
            }
        }

        #lo mismo con este if, la diferencia es que este pondra en el registro la cantidad indexada en el request
        if($request->Abono != false){
            if(!in_array($mes, $meses)){
                return Controller::llamada("Insertar Mes Valido", false);
            }else{
                $cliente->$mes = $request->Abono;
                $indice = array_search($mes, $meses) - 4;
                if ($indice < 0){
                    $indice = ($indice + 1) + 11;
                    $mesABorrar = $meses[$indice];
                    $cliente->$mesABorrar = null;
                    $cliente->save();
                    $pago = Pagos::create([
                        "Cliente"=>$request->Cliente,
                        "Mes"=>$mes,
                        "Pago_Abono"=>"Abono $request->Abono"
                    ]);
                    return Controller::llamada($pago, true);
                }else{
                    $mesABorrar = $meses[$indice];
                    $cliente->$mesABorrar = null;
                    $cliente->save();
                    $pago = Pagos::create([
                        "Cliente"=>$request->Cliente,
                        "Mes"=>$mes,
                        "Pago_Abono"=>"Abono $request->Abono"
                    ]);
                    return Controller::llamada($pago, true);
                }
            }
        }
    }
}   
