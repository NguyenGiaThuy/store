<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->unique()->colorName,
            'brand' => $this->faker->monthName,
            'price' => 1000,
            'type' => $this->faker->firstName,
            'catalog_id' => $this->faker->numberBetween(1, 10),
            'image' => 'https://specials-images.forbesimg.com/imageserve/5e8ce586748506000636107e/960x0.jpg?fit=scale',
        ];
    }
}
