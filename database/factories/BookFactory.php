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
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography', 'Fantasy', 'Technology', 'Romance', 'Mystery'];
        
        return [
            'title' => $this->faker->sentence(rand(3, 6)),
            'author' => $this->faker->name(),
            'publication_year' => $this->faker->year(),
            'category' => $this->faker->randomElement($categories),
            'is_available' => $this->faker->boolean(80), // 80% chance of being available
            'description' => $this->faker->paragraph(rand(3, 5)),
            'cover_image' => null,
        ];
    }
}
