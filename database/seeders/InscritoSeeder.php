<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InscritoLocal;
use App\Models\InscritoCantidad;
use App\Models\InscritoCarrera;
use App\Models\InscritoFacultad;

class InscritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InscritoLocal::create([             
            'LOCALIDAD' => 'SANTA CRUZ',          
            '_INS' => 480,           
        ]);
        InscritoLocal::create([             
            'LOCALIDAD' => 'CAMIRI',          
            '_INS' => 476,           
        ]);
        InscritoLocal::create([             
            'LOCALIDAD' => 'PUERTO SUAREZ',          
            '_INS' => 41,           
        ]);
        InscritoLocal::create([             
            'LOCALIDAD' => 'EL TORNO',          
            '_INS' => 41,           
        ]);
        InscritoCantidad::create([             
            'local_id' => '1',          
            '_INS' => 480,           
        ]);
        InscritoCantidad::create([             
            'local_id' => '1',          
            '_INS' => 806,           
        ]);
        InscritoCantidad::create([             
            'local_id' => '2',          
            '_INS' => 476,           
        ]);
        InscritoCantidad::create([             
            'local_id' => '3',          
            '_INS' => 41,           
        ]);
        InscritoCantidad::create([             
            'local_id' => '4',          
            '_INS' => 19,           
        ]);
// ----------------------------------------------------
        InscritoCarrera::create([             
            'CARRERA' => 'ODONTOLOGIA',          
            '_INS' => 10,           
        ]);
        InscritoCarrera::create([             
            'CARRERA' => 'ELECTRONICA',          
            '_INS' => 200,           
        ]);
        InscritoFacultad::create([             
            'FACULTAD' => 'POLITECNICA',          
            '_INS' => 1550,           
        ]);
        InscritoFacultad::create([             
            'FACULTAD' => 'HUMANIDADES',          
            '_INS' => 1100,           
        ]);
    }
}
