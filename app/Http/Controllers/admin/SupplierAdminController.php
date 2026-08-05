<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Services\Services_admin\SupplierService;

class SupplierAdminController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $suppliers = $this->supplierService->getAll();

        $search = $request->input('search');

        $query = Supplier::query();

        if (!empty('search')) {

        $query->where('name', 'like', '%' . $request->search . '%');

    }


    $suppliers = $query->latest()->get();

        return view(
            'example_admin.content.crud.admin.suppliers.index',
            compact('suppliers')
        );
    }
        public function create()
    {
        return view('example_admin.content.crud.admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'bail|required|regex:/^[0-9]+$/|digits_between:10,15',
            'email' => 'nullable|email',
        ],
        [
            'phone.regex' => 'Nomor HP hanya boleh berisi angka.',
            'phone.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 15 digit.',
        ]);

        $this->supplierService->create(
            $request->only([
                'name',
                'address',
                'phone',
                'email'
            ])
        );

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }
        public function edit($id)
    {
        $supplier = $this->supplierService->find($id);

        return view('example_admin.content.crud.admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'bail|required|regex:/^[0-9]+$/|digits_between:10,15',
            'email'   => 'required|email',
        ],
        [
            'phone.regex' => 'Nomor HP hanya boleh berisi angka.',
            'phone.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 15 digit.',
        ]);

        $this->supplierService->update($id, $request->only([
            'name',
            'address',
            'phone',
            'email'
        ]));

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diubah.');
    }
    public function destroy($id)
    {
    $this->supplierService->delete($id);

    return redirect()
        ->route('admin.suppliers.index')
        ->with('success', 'Kategori berhasil dihapus.');
    }
}
