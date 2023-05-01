<?php

namespace Database\Factories;

use App\Domain\Books\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->firstName.' '.$this->faker->lastName,
            'title' => $this->faker->words(rand(1,10),true),
            'count' => rand(10,100000),
            'price' => rand(10000,10000000)
        ];
    }
}
