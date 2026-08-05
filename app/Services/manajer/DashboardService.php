<?php

namespace App\Services\manajer;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;

class DashboardService
{
    public function getDashboardData(): array
    {
        $pendingTransactions = StockTransaction::where('status', 'Pending')
            ->count();

        $stockIn = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->sum('quantity');

        $stockOut = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->sum('quantity');

        $totalCategories = Category::count();

        $totalProducts = Product::count();

        $totalSuppliers = Supplier::count();

        $totalUsers = User::count();

        return [
            'pending_transactions' => $pendingTransactions,
            'stock_in' => $stockIn,
            'stock_out' => $stockOut,
            'total_categories' => $totalCategories,
            'total_products' => $totalProducts,
            'total_suppliers' => $totalSuppliers,
            'total_users' => $totalUsers,
        ];
    }
}