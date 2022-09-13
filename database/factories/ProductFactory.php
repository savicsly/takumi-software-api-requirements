<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $name = ['Full coverage insurance', 'Compact Car X3', 'SUV Vehicle, high end', 'Basic coverage', 'Convertible X2, Electric'];

        return [
            'sku' => Str::padLeft($this->faker->unique()->numberBetween(1, 1000), 6, '0'),
            'name' => fake()->randomElement($name),
            'price' => random_int(1000, 100000),
            'category_id' => Category::factory()->create()->id,
        ];
    }
}
