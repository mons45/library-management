<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowDate = $this->faker->dateTimeBetween('-2 months', 'now');
        $expectedReturn = $this->faker->dateTimeBetween($borrowDate, '+2 weeks');
        $isReturned = $this->faker->boolean(60); // 60% chance of being returned
        
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'borrow_date' => $borrowDate,
            'expected_return_date' => $expectedReturn,
            'actual_return_date' => $isReturned ? $this->faker->dateTimeBetween($borrowDate, '+3 weeks') : null,
            'is_returned' => $isReturned,
        ];
    }
}
