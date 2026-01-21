<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

/**
 * Class SupplierController
 *
 * Mengelola data pemasok produk (CRUD).
 *
 * @package App\Http\Controllers
 */
class SupplierController extends Controller
{
    /**
     * Menampilkan daftar semua pemasok (suppliers).
     * Dapat difilter berdasarkan nama, penanggung jawab, atau email.
     */
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian dari parameter query 'q'
        $query = $request->get('q');

        // Mengambil data supplier beserta jumlah produk yang terkait
        $suppliers = Supplier::withCount('products')
            ->when($query, function ($q) use ($query) {
                // Filter pencarian berdasarkan nama, orang yang bisa dihubungi, atau email
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('contact_person', 'LIKE', "%{$query}%")
                         ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->latest() // Mengurutkan berdasarkan data terbaru yang ditambahkan
            ->get();
            
        // Mengembalikan view index supplier dengan membawa data hasil query
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Menampilkan form untuk menambahkan pemasok baru.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Menyimpan data pemasok baru ke database.
     */
    public function store(Request $request)
    {
        // Melakukan validasi data yang dikirim melalui form tambah supplier
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        // Menyimpan data yang telah divalidasi ke dalam tabel suppliers
        Supplier::create($validated);

        // Mengalihkan kembali ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully!');
    }

    /**
     * Menampilkan form untuk mengedit data pemasok.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Memperbarui data pemasok di database.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Melakukan validasi data yang dikirim melalui form edit supplier
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        // Memperbarui record supplier yang dipilih dengan data baru
        $supplier->update($validated);

        // Mengalihkan kembali ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    /**
     * Menghapus data pemasok dari database.
     */
    public function destroy(Supplier $supplier)
    {
        // Menghapus data supplier yang dipilih dari database
        $supplier->delete();

        // Mengalihkan kembali ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }
}
