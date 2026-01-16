<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 *
 * Mengelola tampilan dashboard utama aplikasi.
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama.
     * Mengumpulkan statistik dan riwayat transaksi terakhir berdasarkan role pengguna.
     */
    public function index()
    {
        // Mengumpulkan statistik jumlah record untuk ditampilkan di widget dashboard
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'suppliers_count' => Supplier::count(),
            'users_count' => User::count(),
        ];

        $recent_purchases = [];
        $total_revenue = 0;

        // Memeriksa peran pengguna yang sedang login
        if (Auth::user()->role === 'admin') {
            // Jika admin: ambil 5 transaksi terakhir dari semua user dan hitung total revenue semua transaksi yang diterima
            $recent_purchases = Purchase::with(['user', 'product'])->latest()->limit(5)->get();
            $total_revenue = Purchase::where('status', 'accepted')->sum('total_amount');
        } else {
            // Jika user biasa: hanya ambil 5 transaksi terakhir miliknya sendiri dan hitung total pembelanjaan pribadinya
            $recent_purchases = Purchase::with(['product'])->where('user_id', Auth::id())->latest()->limit(5)->get();
            $total_revenue = Purchase::where('user_id', Auth::id())->where('status', 'accepted')->sum('total_amount');
        }

        // Mengirimkan data statistik, riwayat belanja, dan total revenue ke view dashboard
        return view('dashboard', compact('stats', 'recent_purchases', 'total_revenue'));
    }
}
