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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('titulo', 200);
            $table->string('imagen')->nullable();
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->decimal('oferta', 10, 2)->nullable();
            $table->string('modalidad', 20);
            $table->string('tipo_certificado', 30);
            $table->string('horas_academicas', 3);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
