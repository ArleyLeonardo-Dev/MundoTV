<?php

use App\Http\Controllers\PeticionesControler;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
