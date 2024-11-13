<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\NestedSubCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::factory()->count(20)->create();
        SubCategory::factory()->count(50)->create();
        NestedSubCategory::factory()->count(100)->create();
        Product::factory()->count(1_09_000)->create();
    }
}
