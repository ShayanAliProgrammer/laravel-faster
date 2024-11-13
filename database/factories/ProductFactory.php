<?php

namespace Database\Factories;

use App\Models\NestedSubCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nested_sub_category = NestedSubCategory::inRandomOrder()->first(['slug']) ?? NestedSubCategory::factory()->create();

        $name = fake()->text(50);
        $price = rand(100, 1000);
        $description = fake()->paragraph();
        $image = fake()->imageUrl(400, 400);
        $slug = str_replace(' ', '-', $name);

        $existing_product = Product::query()->where('slug', $slug)->first();

        if ($existing_product) {
            $name = fake()->text(50);
            $slug = str_replace(' ', '-', $name);
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'image' => $image,
            'description' => $description,
            'price' => $price,
            'nested_sub_category_slug' => $nested_sub_category->slug,
        ];
    }
}
