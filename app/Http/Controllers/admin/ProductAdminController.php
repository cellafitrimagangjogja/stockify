<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Exports\ProductsExport;
use App\Import\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ActivityLog;

class ProductAdminController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Menampilkan daftar produk
    public function index()
    {
        $products = $this->productService->getAll();

        return view('example_admin.content.crud.admin.products.index', compact('products'))
        ->with('title', 'Product');
    }

    // Menampilkan form tambah produk
    public function create()
    {
         $categories = Category::all();
         $suppliers = Supplier::all();
        return view('example_admin.content.crud.admin.products.create',
        compact('categories', 'suppliers'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        
        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required|max:255',
            'sku' => 'required',
            'description' => 'nullable',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'minimum_stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data = $request->all();

        $product = $this->productService->store($data);
       
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_product',
            'description' => 'Menambahkan produk "' . $product->name . '"',
            'subject_type' => Product::class,
            'subject_id' => $product->id,
        ]);
        
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $product = $this->productService->findById($id);

        $categories = Category::all();
        $suppliers = Supplier::all();


        return view('example_admin.content.crud.admin.products.edit', compact(
            'product',
            'categories',
                       'suppliers'
    ));
    }

    // Mengupdate data
    public function update(Request $request, $id)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'name' => 'required|max:255',
        'category_id' => 'required|integer',
        'supplier_id' => 'required|integer',
        'sku' => 'required',
        'description' => 'nullable',
        'purchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric',
        'minimum_stock' => 'required|integer',
    ]);

    $product = $this->productService->findById($id);

    $data = $request->all();

    if ($request->hasFile('image')) {

        $imageName = $request->file('image')->hashName();

        $request->file('image')->storeAs(
            'products',
            $imageName,
            'public'
        );

        $data['image'] = $imageName;
    }

    $product->update($data);

    $this->productService->update($id, $data);

    return redirect()->route('admin.products.index')
        ->with('success', 'Produk berhasil diperbarui');
}


    public function destroy($id)
{
    $product = Product::findOrFail($id);

    if ($product->stockTransactions()->exists()) {
        return redirect()
            ->route('admin.products.index')
            ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi.');
    }

    $product->delete();

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil dihapus.');
}

public function export()
{
    return Excel::download(
        new ProductsExport,
        'Data_Produk.xlsx'
    );
}

public function import()
{
    return view('example_admin.content.crud.admin.products.import');
}

public function importStore(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    $file = $request->file('file');

    // Simpan file
    $fileName = time() . '_' . $file->getClientOriginalName();

    $file->storeAs('imports', $fileName, 'public');

    // Import ke database
    Excel::import(new ProductImport, $file);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Data berhasil diimport.');
}
}