<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Servicio;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicioFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_servicio_belongs_to_categoria()
    {
        $categoria = Categoria::create([
            'nombre' => 'Derecho Penal',
            'descripcion' => 'Curso penal avanzado',
        ]);

        $servicio = Servicio::create([
            'titulo' => 'Curso de Derecho Penal',
            'descripcion' => 'Descripción...',
            'categoria_id' => $categoria->id,
            'modalidad' => 'virtual',
            'precio' => 100,
            'tipo_certificado' => 'Certificado oficial',
            'horas_academicas' => 30,
            'fecha_inicio' => now(),
            'fecha_fin' => now()->addDays(10),
        ]);

        $this->assertInstanceOf(Categoria::class, $servicio->categoria);
        $this->assertEquals($categoria->id, $servicio->categoria->id);
    }
}

