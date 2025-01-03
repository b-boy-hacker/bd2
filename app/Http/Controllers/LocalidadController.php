<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\CargarExcel;

class LocalidadController extends Controller
{

    //MYSQL
    // public function local_ins()
    // {
    //     // $localidades = DB::table('cargar_excels')
    //     //     ->select('LOCALIDAD', DB::raw('COUNT(_INS) as total_inscritos'))
    //     //     ->groupBy('LOCALIDAD')
    //     //     ->get();
    
    //     $localidades = CargarExcel::select('LOCALIDAD', DB::raw('COUNT(_INS) as total_inscritos'))
    //         ->groupBy('LOCALIDAD')
    //         ->get();

    //     // Aqui vemos el json
    //     // return $localidades;
    //     return view('localidad.inscrito', compact('localidades'));
    // }

    // ----------------------------------------------------------------
    //POSTGRES
    // public function local_ins()
    // {       
    
    //     // $localidades = DB::table('cargar_excels')
    //     // ->select('LOCALIDAD', DB::raw('COUNT("_INS") as total_inscritos'))
    //     // ->groupBy('LOCALIDAD')
    //     // ->get();
    //     $localidades = CargarExcel::select('LOCALIDAD', DB::raw('SUM(CAST("_INS" AS NUMERIC))as total_inscritos'))
    //     ->groupBy('LOCALIDAD')
    //     ->get();

    //     // Aqui vemos el json
    //     // return $localidades;
    //     return view('localidad.inscrito', compact('localidades'));
    // }

    public function local_ins()
    {
        $localidades = CargarExcel::select('LOCALIDAD', DB::raw('SUM(CAST("_INS" AS NUMERIC)) as total_inscritos'))
        ->groupBy('LOCALIDAD')
        ->get();

        // Aqui vemos el json
        // return $localidades;
        return view('localidad.inscrito', compact('localidades'));
    }

}
