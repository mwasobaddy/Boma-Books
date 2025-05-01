<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random category ID from the database
        $categoryId = \App\Models\Category::inRandomOrder()->value('id');
        
        return [
            'title' => $this->faker->catchPhrase(),
            'author' => $this->faker->name(),
            'isbn' => $this->faker->unique()->isbn13(),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 4.99, 49.99),
            'cover_image' => 'https://source.unsplash.com/random/300x450?book',
            'category_id' => $categoryId,
            'stock' => $this->faker->numberBetween(0, 100),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'is_published' => $this->faker->boolean(90), // 90% chance of being published
        ];
    }

    /**
     * Indicate that the book is featured.
     *
     * @return static
     */
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
            ];
        });
    }

    /**
     * Indicate that the book is out of stock.
     *
     * @return static
     */
    public function outOfStock()
    {
        return $this->state(function (array $attributes) {
            return [
                'stock' => 0,
            ];
        });
    }
}
