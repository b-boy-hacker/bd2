<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\InscritoLocal;
use Illuminate\Support\Facades\DB;
use App\Models\InscritoCarrera;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\InscritoFacultad;
use App\Imports\FacultadImport;
use App\Models\CargarExcel;
use App\Imports\CargarExcelImport;


class InscritoController extends Controller
{

    public function poblar()
    {
        $data = CargarExcel::all();

    // Pasar los datos a la vista
        return view('inscrito.cargar_excel', ['data' => $data]);
    }

    public function cargarExcel(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new CargarExcelImport, $request->file('archivo'));

        return redirect()->back()->with('success', 'Archivo importado exitosamente!');
    }


    public function excel()
    {
        $data = InscritoFacultad::select('FACULTAD', '_INS')->get();

    // Pasar los datos a la vista
        return view('inscrito.excel', ['data' => $data]);
    }

    public function importar(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new FacultadImport, $request->file('archivo'));

        return redirect()->back()->with('success', 'Archivo importado exitosamente!');
    }

    // public function inscrito()
    // {  
        // $data = DB::table('inscrito_locals')
        // ->select('LOCALIDAD as country', DB::raw('SUM(_INS) as value'))
        // ->groupBy('LOCALIDAD')
        // ->get();
    
        // $data = DB::table('inscrito_locals')
        //     ->select('LOCALIDAD as country', '_INS as value')
        //     ->get();

    //         $data = DB::table('inscrito_locals')
    //         ->join('inscrito_cantidads', 'inscrito_locals.id', '=', 'inscrito_cantidads.local_id')
    //         ->select('inscrito_locals.LOCALIDAD', DB::raw('SUM(inscrito_cantidads._INS) as total_inscritos'))
    //         ->groupBy('inscrito_locals.LOCALIDAD')
    //         ->get();

    //     // Pasar los datos a la vista
    //     return view('inscrito.localidad', ['data' => $data]);        
    // }

    public function inscrito()
    {
        $data = DB::table('inscrito_locals')
            ->join('inscrito_cantidads', 'inscrito_locals.id', '=', 'inscrito_cantidads.local_id')
            ->select('inscrito_locals.LOCALIDAD', DB::raw('SUM(inscrito_cantidads._INS) as total_inscritos'))
            ->groupBy('inscrito_locals.LOCALIDAD')
            ->get();

        // Convertir los datos a un formato adecuado (asegúrate de que 'total_inscritos' sea un número)
        $data = $data->map(function($item) {
            return [
                "country" => $item->LOCALIDAD,
                "value" => (int) $item->total_inscritos // Asegúrate de que el valor es un número entero
            ];
        });

        return view('inscrito.localidad', ['data' => $data]);
    }

    public function carrera()
    {
        // Obtener todos los registros de la tabla
        $data = InscritoCarrera::all()->map(function($item) {
            // Aplicar transformación en cada registro
            return [
                "carrera" => $item->CARRERA,
                "value" => $item->_INS
            ];
        });

        // Pasar los datos transformados a la vista
        return view('inscrito.carrera', ['data' => $data]);
    }

    public function facultad()
    {
        $data = InscritoFacultad::select('FACULTAD', '_INS')->get();

    // Pasar los datos a la vista
        return view('inscrito.facultad', ['data' => $data]);
    }

    

    

}
