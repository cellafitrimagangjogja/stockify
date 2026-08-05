<?php

namespace App\Http\Controllers\manajer;

use Illuminate\Http\Request;
use App\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Menampilkan daftar produk
    public function index(Request $request)
    {
        $query = Product::query();

        // Search berdasarkan nama produk
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil data produk
        $products = $query->latest()->get();

        return view(
            'example.content.crud.products',
            compact('products')
        );
    }


    // Menampilkan form tambah produk
    public function create()
{
    $categories = Category::all();
    $suppliers = Supplier::all();

    return view(
        'example_manager.products.create',
        compact('categories', 'products')
    );
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
        $this->productService->store($data);


        return redirect()->route('manajer.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $product = $this->productService->findById($id);

        $categories = Category::all();
        $suppliers = Supplier::all();


        return view('example.content.crud.manajer.products.edit', compact(
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

    return redirect()->route('manajer.products.index')
        ->with('success', 'Produk berhasil diperbarui');
}


    public function destroy($id)
{
    $this->productService->delete($id);

    return redirect()
        ->route('manajer.products.index')
        ->with('success', 'Produk berhasil dihapus.');
}
}