<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class roleController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:ver-roles', ['only' => ['index']]);
        $this->middleware('permission:create-roles', ['only' => ['create']]);
        $this->middleware('permission:edit-roles', ['only' => ['edit']]);
        $this->middleware('permission:update-roles', ['only' => ['toggleEstado']]);
    }

    public function index()
    {
        //
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permisos = Permission::all();
        return view('admin.create-roles', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validación
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
                'unique:roles,name' // <- Esto valida duplicados
            ],
            'permission' => 'required|array|min:1',
            'permission.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.string' => 'El nombre del rol debe ser una cadena de texto válida.',
            'name.max' => 'El nombre del rol no debe exceder los 255 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'name.unique' => 'Este nombre de rol ya existe.',
            'permission.required' => 'Debes seleccionar al menos un permiso.',
            'permission.array' => 'Los permisos deben enviarse en formato de lista.',
            'permission.min' => 'Debes seleccionar al menos un permiso.',
            'permission.*.exists' => 'Uno o más permisos seleccionados no son válidos.'
        ]);


        try {
            DB::beginTransaction();

            // Crear el rol
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web'
            ]);

            // Obtener los permisos como colección
            $permissions = Permission::whereIn('id', $validated['permission'])->get();

            // Asignar permisos al rol
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Rol y permisos asignados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            lOG::error('Error al crear el rol o asignar permisos: ' . $e->getMessage());
            return redirect()->route('roles.index')->withErrors(['error' => 'Hubo un error al crear el rol o asignar los permisos.']);
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
    public function edit(Role $role)
    {
        //
        $permisos = Permission::all();
        return view('admin.update-roles', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // Validación
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
                'permission' => 'required|array',
                'permission.*' => 'exists:permissions,id',
            ],
            [
                'name.required' => 'El nombre del rol es obligatorio.',
                'name.string' => 'El nombre del rol debe ser una cadena de texto.',
                'name.max' => 'El nombre del rol no debe superar los 255 caracteres.',
                'name.unique' => 'Este nombre de rol ya está registrado.',

                'permission.required' => 'Debes seleccionar al menos un permiso.',
                'permission.array' => 'Los permisos deben ser una lista válida.',
                'permission.*.exists' => 'Uno o más permisos seleccionados no existen.',
            ]
        );

        try {
            DB::beginTransaction();

            // Obtener el rol
            $role = Role::findOrFail($id);

            // Actualizar el nombre
            $role->update(['name' => $validated['name']]);

            // Obtener los permisos como colección
            $permissions = Permission::whereIn('id', $validated['permission'])->get();

            // Sincronizar permisos (esto elimina los permisos antiguos y asigna los nuevos)
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Rol y permisos actualizados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el rol o permisos: ' . $e->getMessage());

            return redirect()
                ->route('roles.index')
                ->withErrors(['error' => 'Hubo un error al actualizar el rol o los permisos.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
