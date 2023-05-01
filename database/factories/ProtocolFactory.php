<?php

namespace Database\Factories;

use App\Domain\Books\Models\Book;
use App\Domain\Buyers\Models\Buyer;
use App\Domain\Protocols\Models\Protocol;
use App\Domain\Sellers\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Protocol>
 */
class ProtocolFactory extends Factory
{
    protected $model = Protocol::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book_id = Book::all()->random();
        $buyer_id = Buyer::all()->random();
        $seller_id = Seller::all()->random();
        return [
            'date' => $this->faker->date,
            'book_id' => $book_id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id
        ];
    }
}
