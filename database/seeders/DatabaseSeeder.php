<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Partner;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Partner::factory(10)->create();

        $this->call([UserSeeder::class]);
        User::all();

        $this->call([CategorySeeder::class]);
        Product::factory(20)->recycle([
            Category::all()
        ])->create();
    }
}
