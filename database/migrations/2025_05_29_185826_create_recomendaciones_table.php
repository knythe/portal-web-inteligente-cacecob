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
        Schema::create('recomendaciones', function (Blueprint $table) {
            $table->id();

            // A quién va dirigida la recomendación (cliente)
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            // Qué servicio se recomendó
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            // Campo para almacenar resumen/motivo de la recomendación (opcional, generado por Gemini)
            $table->text('razon')->nullable();
            // Puntuación de afinidad o relevancia, si Gemini retorna algo como esto
            $table->decimal('relevancia', 5, 2)->nullable(); // Ej: 87.23%
            // Si fue una recomendación automática (IA) o manual (admin)
            $table->enum('tipo', ['gemini', 'manual'])->default('gemini');
            // Estado de la recomendación (vista o no vista)
            $table->boolean('vista')->default(false);
            // Fecha y hora en que se generó
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendaciones');
    }
};
