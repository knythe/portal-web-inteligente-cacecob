<?php

namespace App\Http\Controllers;

use App\Exports\ServiciosExport;
use App\Http\Requests\storeServiciosRequest;
use App\Http\Requests\updateServiciosRequest;
use App\Models\categoria;
use App\Models\servicio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function Ramsey\Uuid\v8;

class servicioController extends Controller
{
    
     function __construct()
    {

        $this->middleware('permission:ver-servicios', ['only' => ['index']]);
        $this->middleware('permission:create-servicios', ['only' => ['create']]);
        $this->middleware('permission:edit-servicios', ['only' => ['edit']]);
        $this->middleware('permission:update-servicios', ['only' => ['toggleEstado']]);
    }

    public function index()
    {
        //
        $servicios = servicio::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.servicios', compact('servicios'));
        
    }

    public function exportexcel()
    {
        return Excel::download(new ServiciosExport, 'report-servicios.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = categoria::where('estado', 1)->get();
        return view('admin.create-servicios', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeServiciosRequest $request)
    {
        //
        //
        //dd($request);

        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('servicios', 'public'); //guarda la img en storage/app/public/servicios
            $data['imagen'] = $path; // corregido

        }

        try {
            DB::beginTransaction();
            $servicio = servicio::create($data);
            DB::commit();
            return redirect()->route('servicios.index')->with('success', 'Servicio registrado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('servicios.index')->with('error', 'Error al registrar el servicio: ' . $e->getMessage());
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
    public function edit(servicio $servicio)
    {
        //
        $categorias = categoria::where('estado', 1)->get();
        return view('admin.update-servicios', compact('servicio', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateServiciosRequest $request, servicio $servicio)
    {
        //
        $data = $request->validated();


        // Procesar imagen si viene
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('servicios', 'public');
            $data['imagen'] = $path;
        }


        try {
            DB::beginTransaction();

            $servicio->update($data);

            DB::commit();
            return redirect()->route('servicios.index')->with('success', 'servicio actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('servicios.index')->with('error', 'Error al actualizar el servicio.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /* function cambio de estate en servicio*/
    public function toggleEstado(Request $request, $id)
    {
        $servicio = servicio::findOrFail($id);

        $servicio->estado = $request->estado ? 1 : 0;
        $servicio->save();

        return response()->json([
            'success' => true,
            'estado' => $servicio->estado
        ]);
    }
}
