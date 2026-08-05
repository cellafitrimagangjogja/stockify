<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\manajer\StockTransactionService;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class TransaksiBarangMasukController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = StockTransaction::with('product')
            ->where('type', 'Masuk')
            ->latest()
            ->get();

        return view(
            'example.content.crud.manajer.transaksimasuk.index',
            compact('transactions')
        );
    }

    public function create()
    {
        $products = Product::all();

        return view(
            'example.content.crud.manajer.transaksimasuk.create',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'date'       => 'required|date',
            'notes'      => 'nullable|string',
        ]);

        $transaction = StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id'    => auth()->id(),
            'type'       => 'masuk',
            'quantity'   => $request->quantity,
            'date'       => $request->date,
            'status'     => 'Pending',
            'notes'      => $request->notes,
        ]);

        // Load relasi product agar nama produk bisa dipakai
        $transaction->load('product');

        // Simpan aktivitas Manager
        ActivityLog::create([
            'user_id'      => auth()->id(),
            'action'       => 'create_stock_in',
            'description'  => 'Mengajukan barang masuk "' .
                                $transaction->product->name .
                                '" sebanyak ' .
                                $transaction->quantity,
            'subject_type' => StockTransaction::class,
            'subject_id'   => $transaction->id,
        ]);

        return redirect()
            ->route('transaksi-barangmasuk.index')
            ->with('success', 'Transaksi barang masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksibarangmasuk = StockTransaction::findOrFail($id);

        $products = Product::all();

        return view(
            'example.content.crud.manajer.transaksimasuk.edit',
            compact('transaksibarangmasuk', 'products')
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
            ->route('transaksi-barangmasuk.index')
            ->with('success', 'Transaksi barang masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
    $this->stockTransactionService->delete($id);

    return redirect()
        ->route('transaksi-barangmasuk.index')
        ->with('success', 'Transaksi berhasil dihapus.');
    }
}