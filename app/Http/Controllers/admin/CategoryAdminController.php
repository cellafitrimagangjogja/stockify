<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Services_admin\CategoryService;
use App\Models\Category;


class CategoryAdminController extends Controller
{
    protected $categoryService;

public function __construct(CategoryService $categoryService)
{
    $this->categoryService = $categoryService;
}
    public function index()
{
    $categories = $this->categoryService->getAll();

    return view('example_admin.content.crud.admin.categories.categories', compact('categories'))
        ->with('title', 'Category');
}

    public function create()
    {
        return view('example_admin.content.crud..admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|max:255',
        'description' => 'nullable'
    ]);

    Category::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
         $category = Category::findOrFail($id);

        return view(
            'example_admin.content.crud.admin.categories.edit',
            compact('category')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        ]);

        $this->categoryService->update($id, $request->only([
            'name',
            'description'
        ]));

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
    $this->categoryService->delete($id);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Kategori berhasil dihapus.');
    }
}