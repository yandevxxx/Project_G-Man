<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 *
 * Mengelola data produk, termasuk upload gambar.
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk.
     * Dapat difilter berdasarkan nama atau deskripsi melalui query pencarian.
     */
    public function index(Request $request)
    {
        // Mengambil query pencarian dari input 'q'
        $query = $request->get('q');

        // Mengambil produk beserta relasi kategori dan suppliernya
        $products = Product::with(['category', 'supplier'])
            ->when($query, function ($q) use ($query) {
                // Filter pencarian berdasarkan nama atau deskripsi
                return $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->latest() // Urutkan berdasarkan data terbaru
            ->get();

        // Mengembalikan view index produk dengan data hasil query
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk menambahkan produk baru.
     * Mengambil data kategori dan supplier untuk pilihan dropdown.
     */
    public function create()
    {
        // Mengambil semua data kategori dan supplier untuk ditampilkan di dropdown form
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Mengembalikan view create produk
        return view('products.create', compact('categories', suppliers));
    }

    /**
     * Menyimpan data produk baru ke database.
     * Menangani proses upload gambar produk jika ada.
     */
    public function store(Request $request)
    {
        // Validasi data input produk
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage public/products
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Menyimpan record produk baru ke database
        Product::create($data);

        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data produk.
     */
    public function edit(Product $product)
    {
        // Mengambil semua kategori dan supplier untuk dropdown di form edit
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Mengembalikan view edit dengan data produk yang akan diubah
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Memperbarui data produk di database.
     * Menghapus gambar lama jika ada gambar baru yang diunggah.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi data input untuk update produk
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cek jika user mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Jika produk sudah punya gambar sebelumnya, hapus file gambar lama dari storage
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru ke storage
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Memperbarui record produk di database
        $product->update($data);

        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Menghapus produk dari database dan juga menghapus file gambarnya.
     */
    public function destroy(Product $product)
    {
        // Jika produk memiliki gambar, hapus file gambarnya dari storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        // Menghapus record produk dari database
        $product->delete();

        // Redirect kembali ke daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
