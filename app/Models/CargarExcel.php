<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargarExcel extends Model
{
     // Definir la tabla asociada al modelo, si el nombre no sigue la convención
     protected $table = 'cargar_excels';

     // Definir los atributos que pueden ser asignados en masa
     protected $fillable = [
        'FAC_NOMBRE_FACULTAD',
        'CARRE_NOMBRE_CARRERA',
        'PERIOD',
        'LOCALIDAD',
         'MODALIDAD_T',
         '_INS',
         'T_NUE',
         'T_ANT',
         'MAT_INS',
         'SIN_NOT',
         '%SNOT',
         'APROBAD',
         '%APRO',
         'REPROBA',
         '%REPR',
         'R_CON_0',
         '%REP0',
         'MORAS',
         '%MORA',
         'RETIR',
         'PPA',
         'PPS',
         'PPA1',
         'PPAC',
         'EGRE',
         'TIT',
         'Periodo',
     ];
}
