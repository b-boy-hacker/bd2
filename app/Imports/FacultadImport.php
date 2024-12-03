<?php

namespace App\Imports;

use App\Models\InscritoFacultad;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacultadImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row); 
        return new InscritoFacultad([
            'FACULTAD' => $row['facultad'], // Ajusta según el nombre del encabezado en tu archivo Excel
            '_INS'     => $row['ins'], // Asegúrate de que el nombre coincida con el encabezado exacto
        ]);
    }
}
