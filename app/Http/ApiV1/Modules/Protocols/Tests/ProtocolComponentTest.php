<?php

use App\Domain\Books\Models\Book;
use App\Domain\Buyers\Models\Buyer;
use App\Domain\Protocols\Models\Protocol;
use App\Domain\Sellers\Models\Seller;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

uses(TestCase::class);
uses(DatabaseTransactions::class);
uses()->group('component');

test('GET /api/v1/protocols/{id} 200', function () {
    $protocol = Protocol::factory()->create();
    getJson('/api/v1/protocols/'.$protocol->id)
        ->assertStatus(200)
        ->assertJsonPath('data.id', $protocol->id);
});

test('GET /api/v1/protocols/{id} 404', function () {
    $protocol = Protocol::factory()->create();
    getJson('/api/v1/protocols/'.$protocol->id+1)
        ->assertStatus(404);
});

test('DELETE /api/v1/protocols/{id} 200', function () {
    $protocol = Protocol::factory()->create();
    $id = $protocol->id;
    deleteJson('/api/v1/protocols/'.$id)
        ->assertStatus(200)
        ->assertJson(['data' => null]);
    assertDatabaseMissing('protocols',['id' => $id]);
});

test('PATCH all protocol fields /api/v1/protocols/{id} 200', function () {
    $protocol = Protocol::factory()->create();
    $book = Book::factory()->create();
    $buyer = Buyer::factory()->create();
    $seller = Seller::factory()->create();
    patchJson('/api/v1/protocols/'.$protocol->id,
        ["date" => "2000-01-25", "book_id" => $book->id, "buyer_id" => $buyer->id, "seller_id" => $seller->id])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $protocol->id);
    assertDatabaseHas('protocols',
        ['id' => $protocol->id, "date" => "2000-01-25", "book_id" => $book->id, "buyer_id" => $buyer->id, "seller_id" => $seller->id]);
});

test('PATCH protocol date only /api/v1/protocols/{id} 200', function () {
    $protocol = Protocol::factory()->create();
    patchJson('/api/v1/protocols/'.$protocol->id, ["date" => "2000-01-25"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $protocol->id);
    assertDatabaseHas('protocols',
        ['id' => $protocol->id, "date" => "2000-01-25", "book_id" => $protocol->book_id, "buyer_id" => $protocol->buyer_id, "seller_id" => $protocol->seller_id]);
});

test('PATCH /api/v1/protocols/{id} 404', function () {
    $protocol = Protocol::factory()->create();
    patchJson('/api/v1/protocols/' . $protocol->id + 1, ["fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"])
        ->assertStatus(404);
});

test('POST /api/v1/protocols 201', function () {
    $book = Book::factory()->create();
    $buyer = Buyer::factory()->create();
    $seller = Seller::factory()->create();
    $protocol = postJson('/api/v1/protocols',
        ["date" => "2000-01-25", "book_id" => $book->id, "buyer_id" => $buyer->id, "seller_id" => $seller->id])
        ->assertStatus(201);
    assertDatabaseHas('protocols',
        ['id' => $protocol->json('data.id'), "date" => "2000-01-25", "book_id" => $book->id, "buyer_id" => $buyer->id, "seller_id" => $seller->id]);
});
