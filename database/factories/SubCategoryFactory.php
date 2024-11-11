<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->text(50);

        // Ensure there's an existing category to reference
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        return [
            'name' => $name,
            'slug' => str_replace(' ', '-', $name),
            'image' => fake()->imageUrl(),
            'category_slug' => $category->slug, // Sets category_slug to an existing slug from categories
        ];
    }
}
