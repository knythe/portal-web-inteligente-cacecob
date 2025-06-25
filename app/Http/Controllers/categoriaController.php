<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeCategoriasRequest;
use App\Http\Requests\updateCategoriasRequest;
use App\Models\categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = categoria::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.categorias', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-categorias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCategoriasRequest $request)
    {
        try {
            DB::beginTransaction();

            $categoria = Categoria::create($request->validated());

            DB::commit();
            return redirect()->route('categorias.index')->with('success', 'Categoría registrada exitosamente');
        } catch (Exception $e) {
            DB::rollBack();

            // Puedes registrar el error si quieres debug
            // Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al registrar la categoría');
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
    public function edit(categoria $categoria)
    {
        //

        return view('admin.update-categorias', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(updateCategoriasRequest $request, categoria $categoria)
    {
        try {
            DB::beginTransaction();

            $categoria->update($request->validated());

            DB::commit();

            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('categorias.index')->with('error', 'Error al actualizar la categoría');
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
        $categoria = categoria::findOrFail($id);

        $categoria->estado = $request->estado ? 1 : 0;
        $categoria->save();

        return response()->json([
            'success' => true,
            'estado' => $categoria->estado
        ]);
    }
}
