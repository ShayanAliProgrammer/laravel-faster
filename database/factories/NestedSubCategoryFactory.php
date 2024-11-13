<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NestedSubCategory>
 */
class NestedSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sub_category = SubCategory::inRandomOrder()->first(['slug']) ?? SubCategory::factory()->create();

        $name = fake()->text(50);

        return [
            'name' => $name,
            'slug' => str_replace(' ', '-', $name),
            'image' => fake()->imageUrl(60, 60),
            'sub_category_slug' => $sub_category->slug
        ];
    }
}
