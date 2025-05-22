<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class DashboardCategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();

        return response()->view('dashboard.categories.index', [
            'title' => 'Categories',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('dashboard.categories.create', [
            'title' => 'Create New Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255']
        ]);

        $this->categoryService->createCategory($validatedData);
        return redirect('dashboard/categories')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = $this->categoryService->getCategoryWithProducts($category);

        return response()->view('dashboard.categories.show', [
            'category' => $category,
            'title' => 'Category Detail',
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'title' => 'Edit Category',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3', 'max:255']
        ]);

        $this->categoryService->updateCategory($category, $validatedData);
        return redirect('dashboard/categories')->with('success', 'The category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategorywithProducts($category);
        return redirect('dashboard/categories')->with('success', 'The category and its products have been deleted!');
    }
}
