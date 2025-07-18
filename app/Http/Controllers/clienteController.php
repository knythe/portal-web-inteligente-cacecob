<?php

namespace App\Http\Controllers;

use App\Exports\ClientesExport;
use App\Http\Requests\UpdateClientesRequest;
use App\Models\cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct() {

        $this->middleware('permission:ver-clientes',['only'=>['index']]);
    }

    public function index()
    {
        //
        $clientes = Cliente::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.clientes', compact('clientes'));
    }

    public function exportexcel()
    {
        return Excel::download(new ClientesExport, 'report-clientes.xlsx');
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

    public function cambiarEstado(Request $request, Cliente $cliente)
    {
        $request->validate(['estado' => 'required|in:1,2,3,4']);
        $cliente->estado = $request->estado;
        $cliente->save();

        // devolvemos JSON con el texto y clases nuevas
        $info = [
            1 => ['texto' => 'Visitante',     'bg' => 'bg-green-100 text-green-700'],
            2 => ['texto' => 'Interesado',    'bg' => 'bg-green-100 text-green-700'],
            3 => ['texto' => 'No interesado', 'bg' => 'bg-red-100  text-red-700'],
            4 => ['texto' => 'Contacto',      'bg' => 'bg-red-100  text-red-700'],
        ][$cliente->estado];

        return response()->json($info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
