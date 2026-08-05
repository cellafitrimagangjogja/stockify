<?php

namespace App\Services\Services_admin;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::latest()->get();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    
    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        return $category->delete();
    }
}