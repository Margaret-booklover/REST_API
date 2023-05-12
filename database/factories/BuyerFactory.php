<?php

namespace Database\Factories;

use App\Domain\Buyers\Models\Buyer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buyer>
 */
class BuyerFactory extends Factory
{
    protected $model = Buyer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fio' => $this->faker->name,
            'status' => $this->faker->word
        ];
    }
}
