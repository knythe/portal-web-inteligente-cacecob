<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriaFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_categoria_correctamente()
    {
        $categoria = Categoria::create([
            'nombre' => 'Derecho Civil',
            'descripcion' => 'Cursos sobre derecho civil',
        ]);

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Derecho Civil'
        ]);
    }
}