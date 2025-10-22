<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // ✅ Validasi input agar aman
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // ✅ Cek role dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'jamaah') {
                return redirect()->route('jamaah.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'role' => 'Role tidak dikenali.'
                ]);
            }
        }

        return back()->withErrors([
            'login' => 'Email atau password salah.'
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Tampilkan form register
     */
    public function showRegisterForm()
    {
        return view('jamaah.register');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required|string|max:20',
        ]);

        // ✅ Simpan user baru dengan role default "jamaah"
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'jamaah',
        ]);

        Auth::login($user);

        return redirect()->route('jamaah.dashboard');
    }
}
