<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_cliente()
    {
        $cliente = Cliente::create([
            'nombres' => 'Luis',
            'apellidos' => 'Gonzales',
            'email' => 'luis@example.com',
            'dni' => '12345678',
            'telefono' => '987654321',
            'cargo' => 'Estudiante',
            'foto' => 'https://lh3.googleusercontent.com/a/default.jpg'
        ]);

        $this->assertDatabaseHas('clientes', [
            'email' => 'luis@example.com',
            'dni' => '12345678'
        ]);
    }
}
