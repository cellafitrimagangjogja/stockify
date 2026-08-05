<?php

namespace App\Services\staff;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class StockStaffService
{

    // DATA BARANG MASUK
    public function getPenerimaan()
    {
        return StockTransaction::with('product')
            ->where('type', 'Masuk')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();
    }

    // DATA BARANG KELUAR
    public function getPengeluaran()
    {
        return StockTransaction::with('product')
            ->where('type', 'Keluar')
            ->where('status', 'Pending')
            ->latest('created_at')
            ->get();
    }

    public function terimaBarang($id)
    {
        return DB::transaction(function () use ($id) {

            $transaction = StockTransaction::with('product')
                ->findOrFail($id);

            // Pastikan masih Pending
            if ($transaction->status !== 'Pending') {
                throw new Exception(
                    'Transaksi sudah diproses.'
                );
            }

            if ($transaction->type !== 'Masuk') {
                throw new Exception(
                    'Transaksi bukan barang masuk.'
                );
            }

            if (!$transaction->product) {
                throw new Exception(
                    'Produk tidak ditemukan.'
                );
            }

            // Tambahkan stok
            $transaction->product->increment(
                'stock',
                $transaction->quantity
            );

            // Ubah status
            $transaction->update([
                'status' => 'Diterima',
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'approve_stock_in',
                'description' => 'Menyetujui barang masuk "' .
                    $transaction->product->name .
                    '" sebanyak ' .
                    $transaction->quantity,
                'subject_type' => StockTransaction::class,
                'subject_id' => $transaction->id,
            ]);

            return $transaction;
        });
    }


    public function tolakBarangMasuk($id)
    {
        $transaction = StockTransaction::findOrFail($id);

        if ($transaction->status !== 'Pending') {
            throw new Exception(
                'Transaksi sudah diproses.'
            );
        }

        if ($transaction->type !== 'Masuk') {
            throw new Exception(
                'Transaksi bukan barang masuk.'
            );
        }

        // Stok tidak berubah
        $transaction->update([
            'status' => 'Ditolak',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'reject_stock_in',
            'description' => 'Menolak barang masuk "' .
                $transaction->product->name .
                '" sebanyak ' .
                $transaction->quantity,
            'subject_type' => StockTransaction::class,
            'subject_id' => $transaction->id,
        ]);

        return $transaction;
    }

    public function keluarkanBarang($id)
    {
        return DB::transaction(function () use ($id) {

            $transaction = StockTransaction::with('product')
                ->findOrFail($id);

            // Pastikan masih Pending
            if ($transaction->status !== 'Pending') {
                throw new Exception(
                    'Transaksi sudah diproses.'
                );
            }

            if ($transaction->type !== 'Keluar') {
                throw new Exception(
                    'Transaksi bukan barang keluar.'
                );
            }

            if (!$transaction->product) {
                throw new Exception(
                    'Produk tidak ditemukan.'
                );
            }

            if (
                $transaction->product->stock
                < $transaction->quantity
            ) {
                throw new Exception(
                    'Stok produk tidak mencukupi.'
                );
            }

            // Kurangi stok
            $transaction->product->decrement(
                'stock',
                $transaction->quantity
            );

            // Ubah status
            $transaction->update([
                'status' => 'Dikeluarkan',
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'approve_stock_out',
                'description' => 'Menyetujui barang keluar "' .
                    $transaction->product->name .
                    '" sebanyak ' .
                    $transaction->quantity,
                'subject_type' => StockTransaction::class,
                'subject_id' => $transaction->id,
            ]);

            return $transaction;
        });
    }

    public function tolakBarangKeluar($id)
    {
        $transaction = StockTransaction::findOrFail($id);

        if ($transaction->status !== 'Pending') {
            throw new Exception(
                'Transaksi sudah diproses.'
            );
        }

        if ($transaction->type !== 'Keluar') {
            throw new Exception(
                'Transaksi bukan barang keluar.'
            );
        }

        $transaction->update([
            'status' => 'Ditolak',
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'reject_stock_out',
            'description' => 'Menolak barang keluar "' .
                $transaction->product->name .
                '" sebanyak ' .
                $transaction->quantity,
            'subject_type' => StockTransaction::class,
            'subject_id' => $transaction->id,
        ]);

        return $transaction;
    }
}