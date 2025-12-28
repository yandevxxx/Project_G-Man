<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();

        $query = $request->input('q');
        $filter = $request->input('filter', 'all');

        if ($user->role !== 'admin') {
            $filter = 'products';
        }

        if (empty($query)) {
            return redirect()->route('dashboard');
        }

        $results = [
            'products' => collect([]),
            'categories' => collect([]),
            'suppliers' => collect([]),
            'users' => collect([]),
        ];

        if ($filter === 'all' || $filter === 'products') {
            $results['products'] = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->with('category')
                ->limit(10)
                ->get();
        }

        if ($filter === 'all' || $filter === 'categories') {
            $results['categories'] = Category::where('name', 'LIKE', "%{$query}%")
                ->limit(10)
                ->get();
        }

        if ($filter === 'all' || $filter === 'suppliers') {
            $results['suppliers'] = Supplier::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%")
                ->limit(10)
                ->get();
        }

        if ($user->role === 'admin' && ($filter === 'all' || $filter === 'users')) {
            $results['users'] = User::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->limit(10)
                ->get();
        }

        $totalResults = $results['products']->count() +
            $results['categories']->count() +
            $results['suppliers']->count() +
            $results['users']->count();

        return view('search.results', compact('results', 'query', 'totalResults', 'filter'));
    }
}
