<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthTestController extends Controller
{
    // funcion test de creacion de usuario o registro
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:admin,cliente', // solo esos 2 por ahora
        ]);

        // Crear el usuario
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Crear rol si no existe
        $role = Role::firstOrCreate(['name' => $request->role]);

        // Asignar rol al usuario
        $user->assignRole($role);

        return response()->json([
            'message' => 'Usuario registrado y rol asignado correctamente',
            'user' => $user,
            'role' => $role->name
        ], 201);
    }

    // funcion test de leer los registros de usuarios
    public function usersView()
    {
        $users = User::get();
        return response()->json([
            'message' => 'Usuarios registrados',
            'user' => $users
        ]);
    }

    // funcion test de actualizacion de usuario
    public function update(Request $request, $id)
    {
        // buscamos al usuario por id
        $user = User::findOrFail($id);

        // Validar los datos
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|string|in:admin,cliente',
        ]);

        // Actualizar datos del usuario
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Buscar o crear el rol
        $role = Role::firstOrCreate(['name' => $request->role]);

        // Quitar roles anteriores y asignar nuevo rol
        $user->syncRoles([$role]);

        return response()->json([
            'message' => 'Usuario actualizado y rol asignado correctamente',
            'user' => $user,
            'role' => $role->name
        ], 200);
    }

    // funcion test delete de usuarios
    public function delete($id)
    {
        // Buscar el usuario
        $user = User::findOrFail($id);

        // Eliminar usuario
        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }

    //:: test category

    public function registerCategory(Request $request)
    {

        $request->validate([
            'nombre'     => 'required|string|max:80',
            'descripcion'    => 'required|string',
        ]);

        $categoria = categoria::create([
            'nombre'     => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'message' => 'Categoria registrada correctamente',
            'categoria' => $categoria
        ]);
    }

    public function updateCategory(Request $request, $id)
    {

        $categoria = categoria::findOrFail($id);

        $request->validate([
            'nombre'     => 'required|string|max:80' . $categoria->id,
            'descripcion'    => 'required|string',
        ]);

        $categoria->nombre  = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();


        return response()->json([
            'message' => 'Categoria actualizada',
            'user' => $categoria,
        ], 200);
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
