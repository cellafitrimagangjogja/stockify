<?php

namespace App\Repositories\ProductRepositories;

use App\Models\Product;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductRepositoriesRepositoryImplement extends Eloquent implements ProductRepositoriesRepository
{
    public function getAll()
    {
        return Product::with(['category', 'supplier'])->get();
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
{
    if (
        !empty($data['image']) &&
        $data['image'] instanceof \Illuminate\Http\UploadedFile
    ) {
        $fileName = $data['image']->hashName();

        $data['image']->store('products', 'public');

        $data['image'] = $fileName;
    }

    return Product::create($data);
}

    public function update($id, array $data)
{
    $product = Product::findOrFail($id);

    $product->update($data);

    //return $product;

    return $product;
}

    public function delete($id)
    {
        return Product::destroy($id);
    }
}