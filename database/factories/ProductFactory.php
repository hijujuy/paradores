<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'purchase_price' => $this->faker->numberBetween(3000, 4000),
            'sale_price' => $this->faker->numberBetween(4000, 6000),
            'stock' => $this->faker->numberBetween(10, 15),
            'minimum_stock' => $this->faker->numberBetween(30,35),            
            'expiration_date' => $this->faker->date(),
            'category_id' => $this->faker->numberBetween(1, Category::count())
        ];
    }
}
