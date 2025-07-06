<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\categoria;
use App\Models\cliente;
use App\Models\servicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:ver-dashboard', ['only' => ['dashboard']]);
    }

    // view login
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $dia = Carbon::today();
        $clientesdiarios = cliente::whereDate('created_at', $dia)->count();
        $clientespotenciales = cliente::where('estado', 2)->count();
        $serviciosdisponibles = servicio::where('estado', 1)->count();
        $totalclientes = cliente::count();
        // Obtener el ID de la categoría con más interacciones
        $categoriaMasInteracciones = DB::table('interacciones')
            ->join('servicios', 'interacciones.servicio_id', '=', 'servicios.id')
            ->select('servicios.categoria_id', DB::raw('COUNT(*) as total'))
            ->groupBy('servicios.categoria_id')
            ->orderByDesc('total')
            ->first();

        // Obtener el nombre de esa categoría
        $nombreCategoria = null;
        $totalInteracciones = 0;

        if ($categoriaMasInteracciones) {
            $categoria = categoria::find($categoriaMasInteracciones->categoria_id);
            $nombreCategoria = $categoria ? $categoria->nombre : 'No encontrada';
            $totalInteracciones = $categoriaMasInteracciones->total;
        }

        // === Clientes nuevos en la semana ===
        $dias = collect();
        $clientesPorDia = collect();

        for ($i = 6; $i >= 0; $i--) {
            $fecha = Carbon::today()->subDays($i);
            $dia = $fecha->format('d/m');
            $total = Cliente::whereDate('created_at', $fecha)->count();

            $dias->push($dia);
            $clientesPorDia->push($total);
        }

        // === Interesados y no interesados por mes (últimos 6 meses) ===
        $labelsMeses = collect();
        $interesados = collect();
        $noInteresados = collect();

        for ($i = 5; $i >= 0; $i--) {
            $inicioMes = Carbon::now()->subMonths($i)->startOfMonth();
            $finMes = Carbon::now()->subMonths($i)->endOfMonth();

            $nombreMes = ucfirst($inicioMes->translatedFormat('F'));
            $labelsMeses->push($nombreMes);

            $interesados->push(
                Cliente::whereBetween('created_at', [$inicioMes, $finMes])
                    ->where('estado', 4)
                    ->count()
            );

            $noInteresados->push(
                Cliente::whereBetween('created_at', [$inicioMes, $finMes])
                    ->where('estado', 3)
                    ->count()
            );
        }



        return view('admin.panel', [
            'labelsSemana' => $dias, // para el gráfico de barras
            'clientesPorDia' => $clientesPorDia,
            'labels' => $labelsMeses, // usado en ambos gráficos
            'clientesPorDia' => $clientesPorDia,
            'interesados' => $interesados,
            'noInteresados' => $noInteresados,
        ], compact('clientespotenciales', 'totalclientes', 'serviciosdisponibles', 'nombreCategoria'));
    }



    public function login(Request $request)
    {
        // Valida que vengan los campos
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 1. Buscar al usuario por correo
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Usuario no existe
            return back()->withErrors(['email' => 'Usuario no encontrado.'])->withInput();
        }

        // 2. Revisar estado (1 = activo, 0 = suspendido)
        if ($user->estado != 1) {
            return back()->withErrors(['email' => 'Usuario suspendido.'])->withInput();
        }

        // 3. Verificar contraseña
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Contraseña incorrecta.'])->withInput();
        }

        // 4. Autenticar y regenerar sesión
        Auth::login($user);
        $request->session()->regenerate();

        // 5. Redirigir según rol
        if ($user->hasRole('cliente')) {
            return redirect()->route('portal');
        }

        return redirect()->route('dashboard');   // para roles distintos de 'cliente'
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function loginToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();
        //dd($googleUser);
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                'photo' => $googleUser->getAvatar(),
            ]
        );

        // Registrar también en la tabla clientes (si no existe)
        Cliente::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nombres' => $user->name,
                'apellidos' => null,
                'dni' => null,
                'telefono' => null,
                'cargo' => null,
                'photo' => $user->photo,
                'email' => $user->email, // <-- aquí lo incluyes
                'estado' => 1, // preinscrito
            ]
        );


        // Asegurarse que tenga rol de cliente
        if (!$user->hasRole('cliente')) {
            $user->assignRole('cliente');
        }

        Auth::login($user);

        return redirect()->route('portal');
    }
}
