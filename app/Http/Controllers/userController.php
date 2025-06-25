<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUsersRequest;
use App\Http\Requests\updateUsersRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $users = User::whereDoesntHave('roles', function ($query) {
        $query->where('name', 'cliente');
        })->orderBy('created_at', 'desc')->paginate(5);
        
        return view('admin.usuarios', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('admin.create-usuarios', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUsersRequest $request)
    {
        //
        //dd($request);

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public'); //guarda la img en storage/app/public/users
            $data['photo'] = $path; // corregido

        }

        try {
            DB::beginTransaction();
            $user = User::create($data);
            $user->assignRole($request->rol);
            DB::commit();
            return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Error al registrar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        //
        $roles = Role::all();
        return view('admin.update-usuarios', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUsersRequest $request, User $usuario)
    {
        //dd($request);
        $data = $request->validated();


        // Procesar imagen si viene
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');
            $data['photo'] = $path;
        }

        // Procesar contraseña si se cambia
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        try {
            DB::beginTransaction();
            /*Eso elimina el campo si viene como null, 
            por si alguna parte del sistema reacciona mal ante un null explícito.*/
            if (array_key_exists('password', $data) && is_null($data['password'])) {
                unset($data['password']);
            }

            $usuario->update($data);

            // Actualizar rol
            $role = Role::firstOrCreate(['name' => $request->rol]);
            $usuario->syncRoles([$role]);

            DB::commit();
            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('usuarios.index')->with('error', 'Error al actualizar el usuario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /* function cambio de estate en user*/
    public function toggleEstado(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->estado = $request->estado ? 1 : 0;
        $usuario->save();

        return response()->json([
            'success' => true,
            'estado' => $usuario->estado
        ]);
    }
}
