<?php

namespace App\Imports;

use App\Models\CargarExcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargarExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new CargarExcel([           
            'FAC_NOMBRE_FACULTAD' => $row['fac_nombre_facultad'],
            'CARRE_NOMBRE_CARRERA' => $row['carre_nombre_carrera'],
            'PERIOD' => $row['period'],
            'LOCALIDAD' => $row['localidad'],
            'MODALIDAD_T' => $row['modalidad_t'], 
            '_INS' => $row['ins'],         
            'T_NUE' => $row['t_nue'],        
            'T_ANT' => $row['t_ant'],        
            'MAT_INS' => $row['mat_ins'],
            'SIN_NOT' => $row['sin_not'],
            '%SNOT' => $row['snot'],
            'APROBAD' => $row['aprobad'],
            '%APRO' => $row['apro'],
            'REPROBA' => $row['reproba'],
            '%REPR' => $row['repr'],
            'R_CON_0' => $row['r_con_0'],
            '%REP0' => $row['rep0'],
            'MORAS' => $row['moras'],
            '%MORA' => $row['mora'],
            'RETIR' => $row['retir'],
            'PPA' => $row['ppa'],
            'PPS' => $row['pps'],
            'PPA1' => $row['ppa1'],
            'PPAC' => $row['ppac'],
            'EGRE' => $row['egre'],
            'TIT' => $row['tit'],
            'Periodo' => $row['periodo'],
            // 'Periodo' => $this->evaluateFormula($row['periodo']),            
           
        ]);
    }


    private function evaluateFormula($value)
    {
        // Si es fórmula, evalúa y devuelve el valor calculado
        return is_string($value) && str_contains($value, '=') ? \PhpOffice\PhpSpreadsheet\Calculation\Calculation::getInstance()->calculateFormula($value) : $value;
    }
}
