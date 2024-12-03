<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscritoFacultad extends Model
{
    protected $fillable = [
        'FACULTAD',
        '_INS', // Agrega otros atributos necesarios aquí
    ];
}
