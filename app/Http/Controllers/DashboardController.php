<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'suppliers_count' => Supplier::count(),
            'users_count' => User::count(),
        ];

        $recent_purchases = [];
        $total_revenue = 0;

        if (Auth::user()->role === 'admin') {
            $recent_purchases = Purchase::with(['user', 'product'])->latest()->limit(5)->get();
            $total_revenue = Purchase::where('status', 'accepted')->sum('total_amount');
        } else {
            $recent_purchases = Purchase::with(['product'])->where('user_id', Auth::id())->latest()->limit(5)->get();
            $total_revenue = Purchase::where('user_id', Auth::id())->where('status', 'accepted')->sum('total_amount');
        }

        return view('dashboard', compact('stats', 'recent_purchases', 'total_revenue'));
    }
}
