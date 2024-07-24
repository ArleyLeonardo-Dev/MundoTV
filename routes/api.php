<?php

use App\Http\Controllers\PeticionesControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("peticiones/", [PeticionesControler::class, 'getPeticiones']);
Route::get("peticiones/post/",[PeticionesControler::class, 'postPeticionesTemplate']);
Route::post("peticiones/post/",[PeticionesControler::class, 'postPeticiones']);
Route::get("peticiones/update/",[PeticionesControler::class, 'updatePeticionesTemplate']);
Route::patch("peticiones/update/",[PeticionesControler::class, 'updatePeticiones']);