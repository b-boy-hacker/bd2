<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class CarreraController extends Controller
{
    // public function ppac()
    // {
    //     // Obtener el promedio ponderado acumulado (PPAC) por facultad
    //     $ppac = DB::table('cargar_excels')
    //         ->select('CARRE_NOMBRE_CARRERA', DB::raw('AVG(PPAC) as promedio_ppac'))
    //         ->groupBy('CARRE_NOMBRE_CARRERA')
    //         ->get();

    //     return view('carrera.ppac', compact('ppac'));
    // }


    // public function carrera_ins()
    // {
    //      // Obtener datos agrupados por carrera
    //     $carreras = DB::table('cargar_excels')
    //     ->select('CARRE_NOMBRE_CARRERA', DB::raw('COUNT(_INS) as total_inscritos'))
    //     ->groupBy('CARRE_NOMBRE_CARRERA')
    //     ->get();

    //     return view('carrera.inscrito', compact('carreras'));
    // }

    //---------------------------------------------------------------------
    public function carrera_ins()
    {
         // Obtener datos agrupados por carrera
         $carreras = DB::table('cargar_excels')
        ->select('CARRE_NOMBRE_CARRERA', DB::raw('COUNT("_INS") as total_inscritos'))
        ->groupBy('CARRE_NOMBRE_CARRERA')
        ->get();
     
        return view('carrera.inscrito', compact('carreras'));
    }

    public function ppac()
    {
        // Obtiene el promedio de PPAC por carrera, asegurándose de que el campo PPAC no sea nulo
        $ppac = DB::table('cargar_excels')
            ->select('CARRE_NOMBRE_CARRERA', DB::raw('ROUND(AVG(CAST("PPAC" AS NUMERIC)), 2) as promedio_ppac'))
            ->groupBy('CARRE_NOMBRE_CARRERA')
            ->get();

        // Retorna la vista con los datos del promedio PPAC
        return view('carrera.ppac', compact('ppac'));
    }




}
