<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticiones extends Model
{
    use HasFactory;
    protected $table = "Peticiones";
    protected $fillable = [
        'peticion',
        'nombre',
        'cedula',
        'plan',
        'serial_deco_1',
        'serial_tarjeta_1',
        'serial_deco_2',
        'serial_tarjeta_2',
        'serial_deco_3',
        'serial_tarjeta_3',
        'serial_deco_4',
        'serial_tarjeta_4',
        'serial_deco_5',
        'serial_tarjeta_5'
    ];
}
