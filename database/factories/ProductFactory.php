<?php

namespace Database\Factories;

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
    protected $model=Product::class;
    public function definition(): array
    {
        return [
            'title'       => $this->faker->unique()->sentence(3),
            'description' => $this->faker->paragraph(),
            'image'       => 'default_product_img.png',
            'price'       => $this->faker->randomFloat(2, 20, 10000),
            'quantity'    => $this->faker->numberBetween(0, 2000),
        ];
    }
}
