<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            
                'category_id' => 1,
                'supplier_id' => 1,
                'name' => 'Laptop ASUS Vivobook 15',
                'sku' => 'PRD001',
                'description' => 'Laptop ASUS Vivobook 15 Intel Core i5',
                'purchase_price' => 720000,
                'selling_price' => 785000,
                'image' => 'RQccm8FFx8PjDxJDVnEOd0cacd96SQLk9bosJi7s.jpg',
                'stock' => 10,
                'minimum_stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Product::create([
                'category_id' => 2,
                'supplier_id' => 1,
                'name' => 'Mouse Logitech M220',
                'sku' => 'PRD002',
                'description' => 'Mouse wireless Logitech Silent M220',
                'purchase_price' => 150000,
                'selling_price' => 185000,
                'image' => 'Jh3qP70PiXThwTYZUbgYm29QVoaWo4MXcB8YNZt4.jpg',
                'stock' => 15,
                'minimum_stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Product::create([
                'category_id' => 2,
                'supplier_id' => 2,
                'name' => 'Keyboard Mechanical Fantech',
                'sku' => 'PRD003',
                'description' => 'Keyboard Mechanical RGB',
                'purchase_price' => 320000,
                'selling_price' => 395000,
                'image' => 'uO7Po6BIMtNz4xILKvYPNIOiD4D0fssWSoKJ4eG9.jpg',
                'stock' => 12,
                'minimum_stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Product::create([
                'category_id' => 3,
                'supplier_id' => 2,
                'name' => 'Flashdisk SanDisk 64GB',
                'sku' => 'PRD004',
                'description' => 'USB Flashdisk 64GB USB 3.0',
                'purchase_price' => 90000,
                'selling_price' => 120000,
                'image' => 'vABlLSASt53j88TLJ7iyPgzlue5g8oAspePoNytL.jpg',
                'stock' => 25,
                'minimum_stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        Product::create([
                'category_id' => 1,
                'supplier_id' => 3,
                'name' => 'Monitor LG 24 Inch',
                'sku' => 'PRD005',
                'description' => 'Monitor IPS Full HD 24 Inch',
                'purchase_price' => 185000,
                'selling_price' => 215000,
                'image' => 'vaD5dBi1OhYLQgdjMbQhiRLIvXntb1NBDNV6GgIR.jpg',
                'stock' => 5,
                'minimum_stock' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
