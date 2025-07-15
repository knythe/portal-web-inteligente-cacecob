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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',50);
            $table->string('apellidos',50)->nullable();
            $table->string('email',50)->unique();
            $table->string('dni', 8)->unique()->nullable();
            $table->string('telefono', 9)->nullable();
            $table->string('cargo',30)->nullable(); // Ej: estudiante, juez, docente, etc.
            $table->string('photo')->nullable(); // Avatar desde Google
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
