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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('surname')->comment("Primer Apellido");
            $table->string('secondsurname')->comment("Segundo Apellido");
            $table->string('firstname')->comment("Primer Nombre");
            $table->string('othernames')->comment("Otros Nombres");
            $table->string('countryemployment')->comment("País del empleo");
            $table->string('typeidentifi')->comment("Tipo de Identificación");
            $table->string('numberidentifi')->comment("Número de Identificación");
            $table->string('email')->unique()->comment("Correo electrónico");
            $table->date('dateadmission')->comment("Fecha de ingreso");
            $table->string('area')->comment("Área");
            $table->boolean('stated')->comment("Estado")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
