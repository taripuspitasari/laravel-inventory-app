<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::with('category')->filter(request(['search']))->simplePaginate(7)->withQueryString(),
            'title' => 'Products'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'title' => 'Create New Product',
            'categories' => Category::all()
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
            'price' => ['required', 'min:1'],
            'image' => ['image', 'file', 'max:1024'],
            'description' => ['required']
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products-images');
        }

        $validatedData['isActive'] = $request->stock > 0;

        Product::create($validatedData);
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
            'transactions' => $product->transactions()->paginate(5),
            'category' => $product->category->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
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
            'price' => ['required', 'min:1'],
            'description' => ['required']
        ]);

        $validatedData['isActive'] = $request->stock > 0;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('products-images');
        }

        Product::where('id', $product->id)->update($validatedData);
        return redirect('dashboard/products')->with('success', 'The product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);
        return redirect('dashboard/products')->with('success', 'The product has been deleted!');
    }
}
