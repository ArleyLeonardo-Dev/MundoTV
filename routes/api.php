<?php

use App\Http\Controllers\PeticionesControler;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

#links para hacer llamado a todas las peticiones o a una sola
Route::get("peticiones/", [PeticionesControler::class, 'getPeticiones']);
Route::get("peticiones/search", [PeticionesControler::class, 'getPeticionTemplate']);
Route::post("peticiones/search", [PeticionesControler::class, 'getPeticion']);
#links de metodo POST a la tabla peticiones
Route::get("peticiones/post/",[PeticionesControler::class, 'postPeticionesTemplate']);
Route::post("peticiones/post/",[PeticionesControler::class, 'postPeticiones']);
#links de metodo PATCH a la tabla peticiones
Route::get("peticiones/update/",[PeticionesControler::class, 'updatePeticionesTemplate']);
Route::patch("peticiones/update/",[PeticionesControler::class, 'updatePeticiones']);
#links de metodo DELETE a la tabla peticiones
Route::get("peticiones/delete", [PeticionesControler::class, 'deletePeticionesTemplate']);
Route::delete("peticiones/delete", [PeticionesControler::class, 'deletePeticiones']);


Route::get('Clientes/', [ClientesController::class, 'getAllClientes']);
Route::get('Clientes/search/',[ClientesController::class, 'getClienteTemplate']);
Route::post('Clientes/search/',[ClientesController::class, 'getCliente']);

Route::get('Clientes/post/', [ClientesController::class, 'postClienteTemplate']);
Route::post('Clientes/post/', [ClientesController::class, 'postCliente']);

Route::get('Clientes/update/', [ClientesController::class, 'updateClienteTemplate']);
Route::patch('Clientes/update/', [ClientesController::class, 'updateCliente']);

Route::get('Clientes/delete/', [ClientesController::class, 'deleteClienteTemplate']);
Route::delete('Clientes/delete/', [ClientesController::class, 'deleteCliente']);
