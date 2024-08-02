<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'Clientes';
    protected $fillable = ['Referencia', 'Nombre', 'Ciudad', 'Dia_de_pago', 'Valor_mes'];
}
