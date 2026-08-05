<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with(['category', 'supplier'])
            ->get([
                'name',
                'sku',
                'category_id',
                'supplier_id',
                'purchase_price',
                'selling_price',
                'minimum_stock',
                'description',
            ])
            ->map(function ($product) {
                return [
                    $product->name,
                    $product->sku,
                    $product->category->name ?? '-',
                    $product->supplier->name ?? '-',
                    $product->purchase_price,
                    $product->selling_price,
                    $product->minimum_stock,
                    $product->description,
                ];
            });
    }

    public function headings(): array
    {
        return [
        'Nama Produk',
        'SKU',
        'Kategori',
        'Supplier',
        'Harga Beli',
        'Harga Jual',
        'Minimum Stok',
        'Deskripsi',
        ];
    }
}