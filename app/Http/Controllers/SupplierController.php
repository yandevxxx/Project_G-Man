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
        $query = $request->get('q');
        $suppliers = Supplier::withCount('products')
            ->when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('contact_person', 'LIKE', "%{$query}%")
                         ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();
            
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    /**
     * Menghapus data pemasok dari database.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }
}
