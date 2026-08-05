<?php

namespace App\Services\manajer;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;

class LaporanService
{
    /**
     * Laporan stok barang
     */
    public function getLaporanStok(
        $startDate = null,
        $endDate = null,
        $categoryId = null
    ) {
        $query = Product::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        return $query->get();
    }


    /**
     * Laporan transaksi stok
     */
    public function getLaporanTransaksi(
        $startDate = null,
        $endDate = null,
        $type = null
    ) {
        $query = StockTransaction::with([
            'product',
            'user'
        ]);

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        if ($type) {
            $query->where('type', $type);
        }

        return $query
            ->latest()
            ->get();
    }


    /**
     * Laporan aktivitas pengguna
     */
    public function getLaporanAktivitas(
        $startDate = null,
        $endDate = null
    ) {
        $query = User::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        return $query
            ->latest()
            ->get();
    }
}