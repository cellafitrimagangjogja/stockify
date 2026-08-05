<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductServiceImplementAdmin implements ProductService
{
    public function getAll()
    {
        return Product::with([
            'category',
            'supplier'
        ])
        ->latest()
        ->get();
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
    {
        if (
            isset($data['image']) &&
            $data['image'] instanceof \Illuminate\Http\UploadedFile
        ) {
            $image = $data['image'];

            $imageName = $image->hashName();

            $image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $data['image'] = $imageName;
        }

        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);

        if (
            isset($data['image']) &&
            $data['image'] instanceof \Illuminate\Http\UploadedFile
        ) {
            if (
                $product->image &&
                Storage::disk('public')->exists(
                    'products/' . $product->image
                )
            ) {
                Storage::disk('public')->delete(
                    'products/' . $product->image
                );
            }

            $image = $data['image'];

            $imageName = $image->hashName();

            $image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $data['image'] = $imageName;
        }

        $product->update($data);

        return $product->fresh();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if (
            $product->image &&
            Storage::disk('public')->exists(
                'products/' . $product->image
            )
        ) {
            Storage::disk('public')->delete(
                'products/' . $product->image
            );
        }

        return $product->delete();
    }
}