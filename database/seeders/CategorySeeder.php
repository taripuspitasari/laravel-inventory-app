<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Food',
            'description' => 'A selection of delicious and high-quality dishes, including our signature chicken dimsum, savory snacks, and other flavorful options perfect for any time of the day.',
        ]);

        Category::create([
            'name' => 'Beverages',
            'description' => 'A variety of refreshing drinks, from classic hot teas to iced sweet beverages, perfectly crafted to complement your meals.',
        ]);
    }
}
