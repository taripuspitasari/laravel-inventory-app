<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function getCategoryWithProducts($category)
    {
        return $category->products()->simplePaginate(7);
    }

    public function updateCategory($category, $data)
    {
        return $category->update($data);
    }

    public function deleteCategorywithProducts($category)
    {
        $category->products()->delete();
        $category->delete();
    }
}
