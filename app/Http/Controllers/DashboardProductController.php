<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;

class DashboardProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.products.index', [
            'products' => $this->productService->getAllProducts(request(['search', 'category'])),
            'title' => 'Products',
            'categories' => $categories,
            'category' => Category::find(request('category'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', [
            'title' => 'Create New Product',
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'stock' => ['required', 'integer'],
            'low_stock_threshold' => ['required', 'integer'],
            'price' => ['required', 'min:1'],
            'image' => ['image', 'file', 'max:1024'],
            'description' => ['required']
        ]);

        $this->productService->storeProduct($validatedData);

        return redirect('dashboard/products')->with('success', 'New product has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', [
            'product' => $product,
            'title' => 'Product Detail',
            'category' => $product->category->name,
            'stockMovements' => $product->stockMovements()->latest()->simplePaginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'title' => 'Edit Product'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'stock' => ['required', 'integer'],
            'low_stock_threshold' => ['required', 'integer'],
            'price' => ['required', 'min:1'],
            'description' => ['required']
        ]);

        $this->productService->updateProduct($product, $validatedData);

        return redirect('dashboard/products')->with('success', 'The product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect('dashboard/products')->with('success', 'The product has been deleted!');
    }
}
