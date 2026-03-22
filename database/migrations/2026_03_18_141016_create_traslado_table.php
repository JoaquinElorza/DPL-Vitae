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
        Schema::create('traslado', function (Blueprint $table) {
            $table->id('id_traslado');
            $table->boolean('redondo');
            $table->foreignId('id_servicio')
                    ->constrained('servicio', 'id_servicio');
            $table->foreignId('id_origen')
                    ->constrained('direccion', 'id_direccion');
            $table->foreignId('id_destino')
                    ->constrained('direccion', 'id_direccion');
            $table->foreignId('id_paciente')
                    ->constrained('paciente', 'id_paciente');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslado');
    }
};
