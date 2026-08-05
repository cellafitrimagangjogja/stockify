<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use App\Services\manajer\StockTransactionService;

class TransaksiBarangKeluarController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->where('type', 'Keluar')
            ->latest()
            ->get();

        return view(
            'example.content.crud.manajer.transaksikeluar.index',
            compact('transactions')
        );
    }

    public function create()
    {
        $products = Product::all();

        return view(
            'example.content.crud.manajer.transaksikeluar.create',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => 'Pending',
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('transaksi-barangkeluar.index')
            ->with('success', 'Transaksi barang keluar berhasil ditambahkan.');
    }

    public function show(StockTransaction $transaksibarangkeluar)
    {
        return view(
            'manager.stock.barang-keluar.show',
            compact('transaksibarangkeluar')
        );
    }

    public function edit($id)
    {
        $transaksibarangkeluar = StockTransaction::findOrFail($id);

        $products = Product::all();

        return view(
            'example.content.crud.manajer.transaksikeluar.edit',
            compact('transaksibarangkeluar', 'products')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $this->stockTransactionService->update(
            $id,
            $request->only([
                'product_id',
                'quantity',
                'date',
                'notes',
            ])
        );

        return redirect()
            ->route('transaksi-barangkeluar.index')
            ->with('success', 'Transaksi barang keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
    $this->stockTransactionService->delete($id);

    return redirect()
        ->route('transaksi-barangkeluar.index')
        ->with('success', 'Transaksi berhasil dihapus.');
    }
}