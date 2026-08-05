<?php

namespace App\Services\Product;
use App\Repositories\ProductRepositories\ProductRepositoriesRepository;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductServiceImplement implements ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoriesRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function getAll()
    {
       return $this->productRepository->getAll();
    }

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function findById($id)
    {
         return $this->productRepository->findById($id);
    }

    public function update($id, $data)
    {
        return $this->productRepository->update($id,$data);
    }

    public function delete($id)
{
    $product = $this->productRepository->findById($id);

    if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
        Storage::disk('public')->delete('products/' . $product->image);
    }

    return $this->productRepository->delete($id);
}
}