<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Services\manajer\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Menampilkan daftar supplier
     */
    public function index()
    {
        $suppliers = $this->supplierService->getAll();

        return view(
            'example.content.crud.manajer.supplier.index',
            compact('suppliers')
        );
    }

    /**
     * Menampilkan form tambah supplier
     */
    public function create()
    {
        return view(
            'example.content.crud.manajer.supplier.create'
        );
    }

    /**
     * Menyimpan supplier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
        ]);

        $this->supplierService->create($validated);

        return redirect()
            ->route('manajer.suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit supplier
     */
    public function edit($id)
    {
        $supplier = $this->supplierService->findById($id);

        return view(
            'example.content.crud.manajer.supplier.edit',
            compact('supplier')
        );
    }

    /**
     * Mengupdate supplier
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
        ]);

        $this->supplierService->update($id, $validated);

        return redirect()
            ->route('manajer.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier
     */
    public function destroy($id)
    {
        $this->supplierService->delete($id);

        return redirect()
            ->route('manajer.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}