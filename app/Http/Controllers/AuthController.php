<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- FITUR REGISTER ---

    // 1. Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Proses Simpan Data User Baru
    public function register(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email tidak boleh kembar
            'phone' => 'required|string|max:15',
            'role' => 'required|in:user,owner', // Hanya boleh 'user' atau 'owner'
            'password' => 'required|string|min:6|confirmed', // Harus ada field 'password_confirmation' di form
        ]);

        // Simpan ke Database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']), // Enkripsi password
        ]);

        // Otomatis Login setelah daftar
        Auth::login($user);

        // Redirect ke halaman utama dengan pesan
        return redirect('/')->with('success', 'Akun berhasil dibuat! Selamat datang ' . $user->name);
    }

    // --- FITUR LOGIN ---

    // 3. Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 4. Proses Cek Login
    public function login(Request $request)
    {
        // Validasi input sederhana
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Mencegah session fixation attack

            return redirect()->intended('/')->with('success', 'Berhasil Login!');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // --- FITUR LOGOUT ---
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}