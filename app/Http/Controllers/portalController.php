<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\interaccione;
use App\Models\recomendacione;
use App\Models\servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class portalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Obtener servicios activos, paginados
        $servicios = Servicio::where('estado', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        // Cliente autenticado
        $cliente = auth()->user()->cliente;

        // Verificar si ya tiene recomendaciones
        $yaTiene = Recomendacione::where('cliente_id', $cliente->id)->exists();

        if (!$yaTiene) {
            // Últimas interacciones del cliente
            $interacciones = $cliente->interacciones()
                ->with('servicio')
                ->whereIn('tipo', ['vista', 'favorito'])
                ->latest('fecha_interaccion')
                ->take(5)
                ->get();
            //dd($interacciones->pluck('servicio'));

            if ($interacciones->isNotEmpty()) {
                // Obtener títulos e IDs de categoría
                $serviciosBase = $interacciones->pluck('servicio.titulo')->filter()->unique()->values();
                $categoriasBase = $interacciones->pluck('servicio.categoria_id')->filter()->unique()->values();
                //dd($categoriasBase);
                // Armar prompt para Gemini
                $catalogo = Servicio::where('estado', 1)
                    ->pluck('titulo')
                    ->unique()
                    ->values();

                $prompt = "Tengo un cliente que ha mostrado interés en estos servicios:\n";
                foreach ($serviciosBase as $titulo) {
                    $prompt .= "- $titulo\n";
                }

                $prompt .= "\nMi catálogo de servicios incluye:\n";
                foreach ($catalogo as $titulo) {
                    $prompt .= "- $titulo\n";
                }

                $prompt .= "\nCon base en estos intereses, ¿qué otros servicios del catálogo podría recomendarle? Devuélveme solo títulos exactos que existan en el catálogo.";

                // Llamada a la API de Gemini
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json'
                ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                    'contents' => [[
                        'role' => 'user',
                        'parts' => [['text' => $prompt]]
                    ]]
                ]);

                // Obtener texto de respuesta
                $texto = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                //dd($texto);

                if ($texto) {
                    $lineas = explode("\n", $texto);

                    // Buscar solo servicios existentes de esas categorías
                    $serviciosValidos = Servicio::where('estado', 1)
                        ->whereIn('categoria_id', $categoriasBase)
                        ->get()
                        ->keyBy('titulo'); // indexado por título

                    foreach ($lineas as $linea) {
                        // Limpiar cada línea generada por Gemini
                        $tituloLimpio = trim(Str::of($linea)->replace(['-', '*', '•', '1.', '2.'], '')->trim());

                        if (!$serviciosValidos->has($tituloLimpio)) continue;

                        $servicio = $serviciosValidos->get($tituloLimpio);

                        // Registrar recomendación
                        Recomendacione::updateOrCreate(
                            ['cliente_id' => $cliente->id, 'servicio_id' => $servicio->id],
                            [
                                'razon' => 'Sugerido por Gemini (verificado en base)',
                                'tipo' => 'gemini',
                                'relevancia' => rand(75, 100),
                                'vista' => 1
                            ]
                        );
                    }
                }
            }
        }

        // Obtener recomendaciones existentes para mostrar
        $recomendaciones = Recomendacione::with('servicio')
            ->where('cliente_id', $cliente->id)
            ->orderByDesc('relevancia')
            ->get();

        return view('client.home', compact('servicios', 'recomendaciones'));
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
            $query->where('nombre', 'Diplomados especializados');
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

        /*interaccion por vista de servicio por sesion iniciada*/
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
