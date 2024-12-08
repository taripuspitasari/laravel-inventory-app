<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Pakaian',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat laboriosam adipisci nisi dignissimos cupiditate laudantium, illo quas velit harum assumenda.'
        ]);

        Category::create([
            'name' => 'Aksesoris',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat laboriosam adipisci nisi dignissimos cupiditate laudantium, illo quas velit harum assumenda.'
        ]);

        Category::create([
            'name' => 'Sepatu',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat laboriosam adipisci nisi dignissimos cupiditate laudantium, illo quas velit harum assumenda.'
        ]);
    }
}
