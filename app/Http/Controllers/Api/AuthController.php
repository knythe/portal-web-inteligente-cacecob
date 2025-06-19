<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // view login
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('admin.panel');
    }



    public function login(Request $request)
    {
        //dd($request);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('cliente')) {
                return redirect()->route('portal');
            }

            Auth::logout(); // fallback si no tiene roles válidos
            return back()->withErrors(['email' => 'Rol de usuario no permitido.']);
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
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
