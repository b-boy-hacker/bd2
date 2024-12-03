<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\CargarExcel;

class FacultadController extends Controller
{
    public function facultad_ppac()
    {
          // Obtener el promedio ponderado acumulado (PPAC) por facultad
        $ppac = DB::table('cargar_excels')
        ->select('FAC_NOMBRE_FACULTAD', DB::raw('AVG(PPAC) as promedio_ppac'))
        ->groupBy('FAC_NOMBRE_FACULTAD')
        ->get();

        return view('facultad.ppac', compact('ppac'));
    }

    public function facultad_rendimiento()
    {
        // Obtener el rendimiento académico por facultad
    $rendimiento = DB::table('cargar_excels')
        ->select('FAC_NOMBRE_FACULTAD', 
             DB::raw('SUM(`%SNOT`) as total_desercion'),
             DB::raw('SUM(`%APRO`) as total_aprobacion'))
        ->groupBy('FAC_NOMBRE_FACULTAD')
        ->get();    

        return view('facultad.rendimiento', compact('rendimiento'));
    }

    public function facultad_desertados()
    {
        $desertados = DB::table('cargar_excels')
        ->select('FAC_NOMBRE_FACULTAD', DB::raw('SUM(`%SNOT`) as porcentaje_desercion'))
        ->groupBy('FAC_NOMBRE_FACULTAD')
        ->get();
        // return $porcentajeDesercion;
        return view('facultad.desertados', compact('desertados'));
    }

    public function facultad_egresados()
    {
         // Obtener datos agrupados por carrera
         $egresados = CargarExcel::select('FAC_NOMBRE_FACULTAD', DB::raw('COUNT(EGRE) as total_egresados'))
         ->groupBy('FAC_NOMBRE_FACULTAD')
         ->get();

        return view('facultad.egresados', compact('egresados'));
    }

    public function facultad_ins()
    {
         // Obtener datos agrupados por carrera
        $facultades = DB::table('cargar_excels')
        ->select('FAC_NOMBRE_FACULTAD', DB::raw('COUNT(_INS) as total_inscritos'))
        ->groupBy('FAC_NOMBRE_FACULTAD')
        ->get();

        return view('facultad.inscrito', compact('facultades'));
    }

    public function facultad_titulados()
    {
         // Obtener datos agrupados por carrera
         $titulados = CargarExcel::select('FAC_NOMBRE_FACULTAD', DB::raw('COUNT(TIT) as total_titulados'))
         ->groupBy('FAC_NOMBRE_FACULTAD')
         ->get();

        return view('facultad.titulados', compact('titulados'));
    }
}
