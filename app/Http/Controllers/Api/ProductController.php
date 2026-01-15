<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->filter(request(['search', 'category']))->paginate(10)->withQueryString();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product is not found'], 404);
        }
        return new ProductResource($product);
    }
}
