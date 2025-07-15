<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_usuario_y_asignar_rol()
    {
        $role = Role::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'Anthony',
            'email' => 'admin@portal.com',
            'password' => bcrypt('secret123'),
        ]);

        $user->assignRole('admin');

        $this->assertDatabaseHas('users', ['email' => 'admin@portal.com']);
        $this->assertTrue($user->hasRole('admin'));
    }
}
