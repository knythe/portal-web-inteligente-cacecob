<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\interaccione;
use App\Models\servicio;
use Illuminate\Http\Request;

class portalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicios = Servicio::where('estado', 1)->orderBy('created_at', 'desc')->paginate(3);
        return view('client.home', compact('servicios'));
    }

    public function seminarios()
    {
        $servicios = Servicio::where('estado', 1)->whereHas('categoria', function ($query) {
            $query->where('nombre', 'Seminarios');
        })->paginate(6);
        return view('client.servicios-seminarios', compact('servicios'));
    }

    public function diplomados()
    {
        $servicios = Servicio::where('estado', 1)->whereHas('categoria', function ($query) {
            $query->where('nombre', 'Diplomados');
        })->paginate(6);
        return view('client.servicios-diplomados', compact('servicios'));
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
    public function show($id)
    {
        //
        $categorias = categoria::all();
        $servicio = Servicio::findOrFail($id);
        $cliente = auth()->user()->cliente;
        $estadoFavorito = Interaccione::where([
            'cliente_id' => $cliente->id,
            'servicio_id' => $servicio->id,
            'tipo' => 'favorito',
        ])->exists();
        
        $key = 'vista_' . $servicio->id;

        if (!session()->has($key)) {
            session([$key => true]);

            Interaccione::create([
                'cliente_id' => $cliente->id,
                'servicio_id' => $servicio->id,
                'tipo' => 'vista',
                'fecha_interaccion' => now(),
            ]);
        }
        return view('client.servicios', compact('servicio', 'categorias', 'cliente', 'estadoFavorito'));
    }

    /*interaccion de favorito*/

    public function intFavorito(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        $cliente = auth()->user()->cliente;

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 403);
        }

        // Evita duplicados
        Interaccione::firstOrCreate([
            'cliente_id' => $cliente->id,
            'servicio_id' => $request->servicio_id,
            'tipo' => 'favorito',
        ], [
            'fecha_interaccion' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Interacción registrada.']);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
