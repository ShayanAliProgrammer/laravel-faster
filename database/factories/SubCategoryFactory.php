<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
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

        $category = Category::inRandomOrder()->first(['slug']) ?? Category::factory()->create();

        $existing = SubCategory::where('slug', str_replace(' ', '-', $name))->first();
        if ($existing) {
            $name = fake()->text(50);

            return [
                'name' => $name,
                'slug' => str_replace(' ', '-', $name),
                'image' => fake()->imageUrl(60, 60),
                'description' => fake()->paragraph(),
                'category_slug' => $category->slug
            ];
        }

        return [
            'name' => $name,
            'slug' => str_replace(' ', '-', $name),
            'image' => fake()->imageUrl(60, 60),
            'description' => fake()->paragraph(),
            'category_slug' => $category->slug
        ];
    }
}
