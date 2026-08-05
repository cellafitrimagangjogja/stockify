<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockOpname;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransactionAdminController extends Controller
{
    /**
     * Menampilkan daftar transaksi
     */
    public function index()
    {
        $transactions = StockTransaction::with('product', 'user')
            ->latest()
            ->paginate(10);

        return view('example_admin.stock.index', compact('transactions'));
    }

    /**
     * Menampilkan form tambah transaksi
     */
    public function create()
    {
        $products = Product::all();

        return view('example_admin.stock.create', compact('products'));
    }

    /**
     * Menyimpan transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:Masuk,Keluar',
            'quantity'   => 'required|integer|min:1',
            'date'       => 'required|date',
            'status'     => 'required',
            'note'      => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Barang Keluar
        if ($request->type == 'Keluar') {

            if ($product->stock < $request->quantity) {
                return back()
                    ->withInput()
                    ->with('error', 'Stok tidak mencukupi.');
            }

            $product->stock -= $request->quantity;
        }

        // Barang Masuk
        if ($request->type == 'Masuk') {
            $product->stock += $request->quantity;
        }

        $product->save();

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id'    => Auth::id(),
            'type'       => $request->type,
            'quantity'   => $request->quantity,
            'date'       => $request->date,
            'status'     => $request->status,
            'notes'      => $request->notes,
        ]);

        return redirect()
            ->route('admin.stock-transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Detail transaksi
     */
    public function show(StockTransaction $stockTransaction)
    {
        return view(
            'example_admin.stock.show',
            compact('stockTransaction')
        );
    }

    /**
     * Form edit
     */
    public function edit(StockTransaction $stockTransaction)
    {
        $products = Product::all();

        return view(
            'example_admin.stock.edit',
            compact('stockTransaction', 'products')
        );
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, StockTransaction $stockTransaction)
    {
        $request->validate([
            'status' => 'required',
            'notes'  => 'nullable|string',
        ]);

        $stockTransaction->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        return redirect()
            ->route('admin.stock-transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy(StockTransaction $stockTransaction)
    {
        $product = $stockTransaction->product;

        if ($stockTransaction->type == 'Masuk') {
            $product->stock -= $stockTransaction->quantity;
        } else {
            $product->stock += $stockTransaction->quantity;
        }

        $product->save();

        $stockTransaction->delete();

        return redirect()
            ->route('admin.stock-transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function riwayat()
    {
        $transactions = StockTransaction::with('product')
            ->whereIn('type', ['masuk', 'keluar'])
            ->latest()
            ->get();

        $masukPending = StockTransaction::where('type', 'masuk')
            ->where('status', 'Pending')
            ->count();

        $masukDiterima = StockTransaction::where('type', 'masuk')
            ->where('status', 'Diterima')
            ->count();

        $masukDitolak = StockTransaction::where('type', 'masuk')
            ->where('status', 'Ditolak')
            ->count();

        $keluarPending = StockTransaction::where('type', 'keluar')
        ->where('status', 'Pending')
        ->count();

    $keluarDikeluarkan = StockTransaction::where('type', 'keluar')
        ->where('status', 'Dikeluarkan')
        ->count();

    $keluarDitolak = StockTransaction::where('type', 'keluar')
        ->where('status', 'Ditolak')
        ->count();


    return view(
        'example_admin.content.crud.admin.riwayattransaksi.index',
        compact(
            'transactions',
            'masukPending',
            'masukDiterima',
            'masukDitolak',
            'keluarPending',
            'keluarDikeluarkan',
            'keluarDitolak'
        )
    );
    }

    public function stockOpname()
    {
        $stockOpnames = StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->get();

        return view(
            'example_admin.content.crud.admin.stockopname.index',
            compact('stockOpnames')
        );
    }
}