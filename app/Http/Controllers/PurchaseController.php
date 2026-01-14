<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function catalog(Request $request)
    {
        $query = $request->get('q');
        $products = Product::where('stock', '>', 0)
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with('category', 'supplier')
            ->latest()
            ->paginate(12);
            
        return view('purchases.catalog', compact('products'));
    }

    public function checkout($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->route('purchases.catalog')->with('error', 'Product is out of stock!');
        }

        return view('purchases.checkout', compact('product'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product_id = $request->product_id;
        $quantity = $request->quantity;

        DB::beginTransaction();

        try {
            $product = Product::lockForUpdate()->find($product_id);

            if (!$product || $product->stock < $quantity) {
                throw new \Exception("Product {$product->name} is out of stock or insufficient quantity!");
            }

            $total = $product->price * $quantity;

            Purchase::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_amount' => $total,
                'status' => 'completed',
            ]);

            $product->stock -= $quantity;
            $product->save();

            DB::commit();

            return redirect()->route('purchases.history')->with('success', 'Purchase completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function history(Request $request)
    {
        $query = $request->get('q');
        $purchases = Purchase::where('user_id', Auth::id())
            ->when($query, function ($q) use ($query) {
                return $q->whereHas('product', function ($p) use ($query) {
                    $p->where('name', 'LIKE', "%{$query}%");
                })->orWhere('id', 'LIKE', "%{$query}%");
            })
            ->with(['product'])
            ->latest()
            ->get();

        return view('purchases.history', compact('purchases'));
    }

    public function adminIndex(Request $request)
    {
        $query = $request->get('q');
        $purchases = Purchase::with(['user', 'product'])
            ->when($query, function ($q) use ($query) {
                return $q->whereHas('product', function ($p) use ($query) {
                    $p->where('name', 'LIKE', "%{$query}%");
                })->orWhereHas('user', function ($u) use ($query) {
                    $u->where('name', 'LIKE', "%{$query}%");
                })->orWhere('id', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(15);

        return view('purchases.admin_index', compact('purchases'));
    }
}
