<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class UserController
 *
 * Mengelola data pengguna (CRUD untuk admin) dan profil pengguna.
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna terdaftar.
     * Digunakan oleh Admin untuk manajemen user.
     */
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian dari parameter query 'q'
        $query = $request->get('q');

        // Mengambil data user, filter berdasarkan nama atau email jika ada query pencarian
        $users = User::when($query, function ($q) use ($query) {
            return $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%");
        })
            ->paginate(10); // Melakukan paginasi dengan menampilkan 10 user per halaman

        // Mengembalikan view index user dengan data hasil query
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk mengedit data pengguna lain (Admin).
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna lain di database (Admin).
     */
    public function update(Request $request, User $user)
    {
        // Validasi data input profil user oleh admin
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'in:user,admin'],
            'jenis_kelamin' => ['required', 'string'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        // Memperbarui record user yang dipilih di database
        $user->update($validated);

        // Redirect kembali ke daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Menghapus pengguna dari database (Admin).
     */
    public function destroy(User $user)
    {
        // Menghapus record user dari database
        $user->delete();

        // Redirect kembali ke daftar user dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    /**
     * Menampilkan halaman edit profil untuk diri sendiri.
     */
    public function editProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui data profil pengguna yang sedang login.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        // Mengambil data user yang sedang login saat ini
        $user = Auth::user();

        // Validasi data profil yang akan diperbarui
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'jenis_kelamin' => ['required', 'string'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        // Memperbarui data profil user tersebut di database
        $user->update($validated);

        // Redirect kembali ke halaman edit profil dengan pesan sukses
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
