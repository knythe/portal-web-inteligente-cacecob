<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateClientesRequest;
use App\Models\cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::orderBy('created_at', 'desc')->get();
        return view('admin.clientes', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientesRequest $request, cliente $cliente)
    {
        //dd($request);
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $cliente->update($data);

            DB::commit();
            return redirect()->back()->with('success', 'cliente actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el cliente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
