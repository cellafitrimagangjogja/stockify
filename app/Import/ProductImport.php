<?php

namespace App\Import;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {   
        
        $category = Category::where('name', trim($row['kategori']))->first();
        $supplier = Supplier::where('name', trim($row['supplier']))->first();

        Product::updateOrCreate(
            [
                'sku' => trim($row['sku']),
            ],
            [
                'name' => $row['nama_produk'],
                'category_id' => $category?->id,
                'supplier_id' => $supplier?->id,
                'purchase_price' => $row['harga_beli'],
                'selling_price' => $row['harga_jual'],
                'minimum_stock' => $row['minimum_stok'],
                'description' => $row['deskripsi'],
            ]
        );

        return null;
    }
}