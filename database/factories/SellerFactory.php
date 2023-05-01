<?php

namespace Database\Factories;

use App\Domain\Sellers\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fio' => $this->faker->name,
            'phone' => $this->faker->numerify('+7 9## ### ## ##')
        ];
    }
}
