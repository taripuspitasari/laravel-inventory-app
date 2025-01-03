<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAllProducts($filters)
    {
        return Product::with('category')->filter($filters)->simplePaginate(7)->withQueryString();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function storeProduct($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products-images');
        }

        $data['isActive'] = $data['stock'] > 0;

        return Product::create($data);
    }

    public function updateProduct($product, $data)
    {
        if (isset($data['image'])) {
            if ($data['oldImage']) {
                Storage::delete($data['oldImage']);
            }
            $data['image'] = $data['image']->store('products-images');
        }

        $data['isActive'] = $data['stock'] > 0;

        return $product->update($data);
    }

    public function deleteProduct($product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        return $product->delete();
    }
}
