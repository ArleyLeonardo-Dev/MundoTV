<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticiones extends Model
{
    use HasFactory;
    protected $table = "Peticiones";
    protected $fillable = [
        'Peticion',
        'nombre',
        'cedula',
        'plan',
        'serial deco 1',
        'serial tarjeta 1',
        'serial deco 2',
        'serial tarjeta 2',
        'serial deco 3',
        'serial tarjeta 3',
        'serial deco 4',
        'serial tarjeta 4',
        'serial deco 5',
        'serial tarjeta 5'
    ];
}
