<?php

namespace App\Services\manajer;

use App\Models\StockOpname;
use App\Models\Product;

class StockOpnameService
{
    public function getProducts()
    {
        return Product::all();
    }

    public function getAll()
    {
        return StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->get();
    }

    public function create(array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        $systemStock = $product->stock;
        $physicalStock = $data['physical_stock'];

        $difference = $physicalStock - $systemStock;

        return StockOpname::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'system_stock' => $systemStock,
            'physical_stock' => $physicalStock,
            'difference' => $difference,
            'opname_date' => $data['opname_date'],
            'note' => $data['note'] ?? null,
        ]);
    }
}