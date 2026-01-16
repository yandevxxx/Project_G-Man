<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PurchaseController
 *
 * Mengelola transaksi pembelian, status pesanan, dan upload bukti pembayaran.
 *
 * @package App\Http\Controllers
 */
class PurchaseController extends Controller
{
    /**
     * Menampilkan katalog produk yang tersedia (stok > 0).
     */
    public function catalog(Request $request)
    {
        // Mengambil query pencarian dari input 'q'
        $query = $request->get('q');

        // Menampilkan hanya produk yang memiliki stok lebih dari 0
        $products = Product::where('stock', '>', 0)
            ->when($query, function ($q) use ($query) {
                // Filter pencarian berdasarkan nama atau deskripsi produk
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->with('category', 'supplier') // Memuat relasi kategori dan supplier
            ->latest()
            ->paginate(12); // Paginasi 12 produk per halaman
            
        // Mengembalikan view katalog dengan data produk
        return view('purchases.catalog', compact('products'));
    }

    /**
     * Menampilkan halaman checkout untuk produk tertentu.
     */
    public function checkout($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Memastikan stok tersedia sebelum lanjut ke checkout
        if ($product->stock <= 0) {
            return redirect()->route('purchases.catalog')->with('error', 'Product is out of stock!');
        }

        // Mengembalikan view checkout produk
        return view('purchases.checkout', compact('product'));
    }

    /**
     * Memproses permintaan checkout pembeli.
     * Menyimpan data pembelian dan bukti pembayaran dengan status 'pending'.
     */
    public function processCheckout(Request $request)
    {
        // Validasi data input checkout
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product_id = $request->product_id;
        $quantity = $request->quantity;

        try {
            // Ambil data produk
            $product = Product::findOrFail($product_id);

            // Validasi stok produk apakah mencukupi jumlah pesanan
            if ($product->stock < $quantity) {
                return redirect()->back()->with('error', 'Insufficient stock for ' . $product->name);
            }

            // Menangani upload file bukti pembayaran
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                // Simpan bukti pembayaran ke storage
                $paymentProofPath = $request->file('payment_proof')->store('purchases', 'public');
            }

            // Hitung total biaya (harga produk x jumlah beli)
            $total = $product->price * $quantity;

            // Simpan data transaksi pembelian ke database dengan status awal 'pending'
            Purchase::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_proof' => $paymentProofPath,
            ]);

            // Redirect ke riwayat belanja dengan pesan sukses
            return redirect()->route('purchases.history')->with('success', 'Purchase request submitted! Your payment proof is under review.');
        } catch (\Exception $e) {
            // Jika terjadi error, kembali ke form dengan pesan error
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    /**
     * Menyetujui transaksi pembelian (Admin).
     * Mengurangi stok produk secara otomatis saat disetujui.
     */
    public function approve($id)
    {
        // Menggunakan Database Transaction untuk memastikan integritas data
        DB::beginTransaction();
        try {
            // Mencari data transaksi
            $purchase = Purchase::findOrFail($id);
            
            // Hanya transaksi berstatus 'pending' yang bisa disetujui
            if ($purchase->status !== 'pending') {
                return redirect()->back()->with('error', 'Only pending transactions can be approved.');
            }

            // Mencari produk terkait dan melakukan lock untuk update stok aman (dari race condition)
            $product = Product::lockForUpdate()->findOrFail($purchase->product_id);

            // Cek kembali ketersediaan stok
            if ($product->stock < $purchase->quantity) {
                throw new \Exception("Stock is no longer sufficient for this order.");
            }

            // Kurangi stok produk
            $product->stock -= $purchase->quantity;
            $product->save();

            // Ubah status transaksi menjadi 'accepted'
            $purchase->status = 'accepted';
            $purchase->save();

            // Selesaikan transaksi database
            DB::commit();
            return redirect()->back()->with('success', 'Transaction approved and stock updated!');
        } catch (\Exception $e) {
            // Batalkan semua perubahan jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', 'Approval failed: ' . $e->getMessage());
        }
    }

    /**
     * Menolak transaksi pembelian (Admin).
     */
    public function reject($id)
    {
        try {
            // Mencari data transaksi
            $purchase = Purchase::findOrFail($id);
            
            // Hanya transaksi status 'pending' yang bisa ditolak
            if ($purchase->status !== 'pending') {
                return redirect()->back()->with('error', 'Only pending transactions can be rejected.');
            }

            // Ubah status transaksi menjadi 'rejected'
            $purchase->status = 'rejected';
            $purchase->save();

            return redirect()->back()->with('success', 'Transaction rejected.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Rejection failed: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan riwayat pembelian milik pengguna yang sedang login.
     */
    public function history(Request $request)
    {
        // Ambil query pencarian
        $query = $request->get('q');

        // Mengambil data pembelian milik user saat ini
        $purchases = Purchase::where('user_id', Auth::id())
            ->when($query, function ($q) use ($query) {
                // Filter pencarian berdasarkan nama produk atau ID transaksi
                return $q->whereHas('product', function ($p) use ($query) {
                    $p->where('name', 'LIKE', "%{$query}%");
                })->orWhere('id', 'LIKE', "%{$query}%");
            })
            ->with(['product'])
            ->latest()
            ->get();

        // Mengembalikan view riwayat belanja pengguna
        return view('purchases.history', compact('purchases'));
    }

    /**
     * Menampilkan daftar semua transaksi untuk dikelola oleh admin.
     */
    public function adminIndex(Request $request)
    {
        // Ambil query pencarian
        $query = $request->get('q');

        // Mengambil semua data pembelian untuk dikelola admin
        $purchases = Purchase::with(['user', 'product'])
            ->when($query, function ($q) use ($query) {
                // Filter berdasarkan nama produk, nama user, atau ID transaksi
                return $q->whereHas('product', function ($p) use ($query) {
                    $p->where('name', 'LIKE', "%{$query}%");
                })->orWhereHas('user', function ($u) use ($query) {
                    $u->where('name', 'LIKE', "%{$query}%");
                })->orWhere('id', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(15);

        // Mengembalikan view indeks transaksi admin
        return view('purchases.admin_index', compact('purchases'));
    }
}
