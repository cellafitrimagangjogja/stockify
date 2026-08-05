<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockTransaction;
use App\Models\User;

class DashboardRepository
{
    public function getDashboardData()
    {
        return [
            'total_products'      => product::count(),
            'total_categories'    => Category::count(),
            'total_suppliers'     => Supplier::count(),
            'total_users'         => User::count(),
            'stock_in'            => StockTransaction::where('type','Masuk')->sum('quantity'),
            'stock_out'           => StockTransaction::where('type','Keluar')->sum('quantity'),
            'pending_transactions'=> StockTransaction::where('status','Pending')->count(),
        ];
    }
}