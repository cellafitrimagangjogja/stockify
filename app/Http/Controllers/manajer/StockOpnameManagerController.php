<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Services\manajer\StockOpnameService;

class StockOpnameManagerController extends Controller
{

    protected $stockOpnameService;

        public function __construct(StockOpnameService $stockOpnameService)
        {
            $this->stockOpnameService = $stockOpnameService;
        }
    public function index()
    {
        $products = $this->stockOpnameService->getProducts();

        $stockOpnames = $this->stockOpnameService->getAll();

        return view(
            'example.content.crud.manajer.stockopname.index',
            compact('products', 'stockOpnames')
        );
    }

    public function create()
    {
        $products = Product::all();

        return view(
            'manager.stock.stockopname.create',
            compact('products')
        );
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'physical_stock' => 'required|integer|min:0',
        'opname_date' => 'required|date',
        'note' => 'nullable|string',
    ]);

    $this->stockOpnameService->create($validated);

    return redirect()
        ->route('stockopname.index')
        ->with('success', 'Stock opname berhasil disimpan.');
}

    public function show(StockOpname $stockopname)
    {
        $stockopname->load('product');

        return view(
            'manager.stock.stockopname.show',
            compact('stockopname')
        );
    }

    public function edit(StockOpname $stockopname)
    {
        $products = Product::all();

        return view(
            'manager.stock.stockopname.edit',
            compact('stockopname', 'products')
        );
    }

    public function update(
        Request $request,
        StockOpname $stockopname
    ) {
        $request->validate([
            'physical_stock' => 'required|integer|min:0',
            'opname_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $difference = $request->physical_stock
            - $stockopname->system_stock;

        $stockopname->update([
            'physical_stock' => $request->physical_stock,
            'difference' => $difference,
            'opname_date' => $request->opname_date,
            'note' => $request->note,
        ]);

        // Update stok produk
        $stockopname->product->update([
            'stock' => $request->physical_stock,
        ]);

        return redirect()
            ->route('stockopname.index')
            ->with('success', 'Stock opname berhasil diperbarui.');
    }

    public function destroy(StockOpname $stockopname)
    {
        $stockopname->delete();

        return redirect()
            ->route('stockopname.index')
            ->with('success', 'Stock opname berhasil dihapus.');
    }
}