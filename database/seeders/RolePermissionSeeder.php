<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $cliente = Role::firstOrCreate(['name' => 'cliente']);

        // Permisos (puedes extenderlo)
        $permissions = [
            'ver-dashboard',
            'ver-roles',
            'create-roles',
            'store-roles',
            'show-roles',
            'edit-roles',
            'update-roles',
            'delete-roles',
            'ver-usuarios',
            'create-usuarios',
            'store-usuarios',
            'show-usuarios',
            'edit-usuarios',
            'update-usuarios',
            'delete-usuarios',
            'ver-servicios',
            'create-servicios',
            'store-servicios',
            'show-servicios',
            'edit-servicios',
            'update-servicios',
            'delete-servicios',
            'ver-categorias',
            'create-categorias',
            'store-categorias',
            'show-categorias',
            'edit-categorias',
            'update-categorias',
            'delete-categorias',
            'ver-clientes'

        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $admin->givePermissionTo(Permission::all());
        $cliente->givePermissionTo([]); // Por ahora sin permisos administrativos
    }
}
