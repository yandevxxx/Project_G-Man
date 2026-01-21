<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AuthController
 *
 * Mengelola autentikasi pengguna, termasuk login, registrasi, logout,
 * dan reset password.
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function login()
    {
        // Mengembalikan view login yang terletak di resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Menampilkan halaman registrasi.
     */
    public function register()
    {
        // Mengembalikan view register yang terletak di resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Menyimpan data pengguna baru ke database (Registrasi).
     */
    public function store(Request $request)
    {
        // Validasi input dari form registrasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:user,admin'],
            'jenis_kelamin' => ['required', 'string'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        // Membuat user baru di database dengan password yang sudah di-hash
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
        ]);

        // Langsung melakukan login otomatis setelah berhasil registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Account successfully created!');
    }

    /**
     * Melakukan proses autentikasi (Login).
     */
    public function authenticate(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba mencocokkan kredensial dengan data di database
        if (Auth::attempt($credentials)) {
            // Jika berhasil, regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman dashboard
            return redirect()->route('dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Mengeluarkan pengguna dari sistem (Logout).
     */
    public function logout(Request $request)
    {
        // Melakukan proses logout dari guard Auth
        Auth::logout();

        // Menghapus data session saat ini
        $request->session()->invalidate();

        // Meregenerasi token CSRF baru
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }

    /**
     * Menampilkan halaman lupa password.
     */
    public function forgotPassword()
    {
        // Mengembalikan view forgot-password
        return view('auth.forgot-password');
    }

    /**
     * Memverifikasi email untuk reset password dan langsung tampilkan form reset.
     */
    public function verifyResetCredentials(Request $request)
    {
        // Validasi input email saja
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.'])->withInput();
        }

        // Simpan email di session untuk proses reset
        session(['reset_email' => $request->email]);

        // Langsung tampilkan form reset password
        return view('auth.reset-password', [
            'email' => $request->email
        ]);
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        // Validasi input email dan password baru
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Memastikan email di session cocok dengan email yang dikirim
        if (session('reset_email') !== $request->email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        // Update password user di database
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        // Menghapus data dari session setelah selesai
        session()->forget('reset_email');

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Password has been reset successfully!');
    }
}
