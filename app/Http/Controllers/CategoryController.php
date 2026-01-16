<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * Mengelola data kategori produk (CRUD).
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori produk.
     * Dapat difilter berdasarkan nama jika ada query pencarian.
     */
    public function index(Request $request)
    {
        // Mengambil query pencarian dari input 'q'
        $query = $request->get('q');

        // Mengambil kategori, filter berdasarkan nama jika ada query pencarian
        $categories = Category::when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%");
            })
            ->latest() // Urutkan berdasarkan data terbaru
            ->get();
            
        // Mengembalikan view index kategori dengan data hasil query
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        // Mengembalikan view create kategori
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input nama kategori
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // Menyimpan data kategori baru ke database
        Category::create($request->all());

        // Redirect kembali ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit kategori yang sudah ada.
     */
    public function edit(Category $category)
    {
        // Mengembalikan view edit kategori dengan data kategori yang dipilih
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input perubahan nama kategori
        $request->validate([

            'name' => 'required|string|max:255',
        ]);

        // Memperbarui data kategori di database
        $category->update($request->all());

        // Redirect kembali ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        // Menghapus record kategori dari database
        $category->delete();

        // Redirect kembali ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
