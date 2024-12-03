<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cargar_excels', function (Blueprint $table) {
            $table->id();

            $table->string('FAC_NOMBRE_FACULTAD');
            $table->string('CARRE_NOMBRE_CARRERA');
            $table->string('PERIOD');
            $table->string('LOCALIDAD');
            $table->string('MODALIDAD_T');
            $table->string('_INS');
            $table->string('T_NUE');
            $table->string('T_ANT');
            $table->string('MAT_INS');
            $table->string('SIN_NOT');
            $table->string('%SNOT');
            $table->string('APROBAD');
            $table->string('%APRO');
            $table->string('REPROBA');
            $table->string('%REPR');
            $table->string('R_CON_0');
            $table->string('%REP0');
            $table->string('MORAS');
            $table->string('%MORA');
            $table->string('RETIR');
            $table->string('PPA');
            $table->string('PPS');
            $table->string('PPA1');
            $table->string('PPAC');
            $table->string('EGRE');
            $table->string('TIT');
            $table->string('Periodo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargar_excels');
    }
};
