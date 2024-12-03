<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CargarExcel;
use Illuminate\Support\Facades\DB;


class ModalidadController extends Controller
{
    public function modalidad_ins()
    {        
    
        $modalidades = CargarExcel::select('MODALIDAD_T', DB::raw('COUNT(_INS) as total_inscritos'))
            ->groupBy('MODALIDAD_T')
            ->get();

        // Aqui vemos el json
        // return $localidades;
        return view('modalidad.inscrito', compact('modalidades'));
    }
}
