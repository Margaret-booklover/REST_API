<?php

namespace Database\Seeders;

use App\Domain\Books\Models\Book;
use App\Domain\Buyers\Models\Buyer;
use App\Domain\Protocols\Models\Protocol;
use App\Domain\Sellers\Models\Seller;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory()->count(100)->create();
        Seller::factory()->count(50)->create();
        Buyer::factory()->count(20)->create();
        Protocol::factory()->count(200)->create();
    }
}
