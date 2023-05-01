<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;

use App\Domain\Books\Models\Book;
use function Pest\Laravel\putJson;

uses(TestCase::class);
uses(DatabaseTransactions::class);
uses()->group('component');

test('GET /api/v1/books/{id} 200', function () {
    /** @var Book $book*/
    $book = Book::factory()->create();
    getJson('/api/v1/books/'.$book->id)
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
});

test('GET /api/v1/books/{id} 404', function () {
    /** @var Book $book*/
    $book = Book::factory()->create();
    getJson('/api/v1/books/'.$book->id+1)
        ->assertStatus(404);
});

test('DELETE /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    $id = $book->id;
    deleteJson('/api/v1/books/'.$id)
        ->assertStatus(200)
        ->assertJson(['data' => null]);
    assertDatabaseMissing('books',['id' => $id]);
});

test('PATCH all fields /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id,
        ["author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ["author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000]);
});
test('PATCH author only /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id, ["author" => "Petrov Alexey"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ['id' => $book->id, "author" => "Petrov Alexey", "title" => $book->title, "count" => $book->count, "price" => $book->price]);
});

test('PATCH title only /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id, ["title" => "Sadness"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ['id' => $book->id, "author" => $book->author, "title" => "Sadness", "count" => $book->count, "price" => $book->price]);
});

test('PATCH count only /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id, ['count' => 500])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ['id' => $book->id, "author" => $book->author, "title" => $book->title, "count" => 500, "price" => $book->price]);
});

test('PATCH price only /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id, ['price' => 9500])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ['id' => $book->id, "author" => $book->author, "title" => $book->title, "count" => $book->count, "price" => 9500]);
});

test('PATCH /api/v1/books/{id} 404', function () {
    $book = Book::factory()->create();
    patchJson('/api/v1/books/'.$book->id+1,
        ["author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000])
        ->assertStatus(404);
});

test('POST /api/v1/books 201', function () {
    $temp = postJson('/api/v1/books',
        ["author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000])
        ->assertStatus(201);
    assertDatabaseHas('books',
        ['id' => $temp->json('data.id'), "author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000]);
});

test('PUT /api/v1/books/{id} 200', function () {
    $book = Book::factory()->create();
    putJson('/api/v1/books/' . $book->id,
        ["author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $book->id);
    assertDatabaseHas('books', ["id" => $book->id, "author" => "Petrov Alexey", "title" => "Sadness", 'count' => 500, 'price' => 9000]);
});

test('PUT /api/v1/books/{id} 400', function () {
    $book = Book::factory()->create();
    putJson('/api/v1/books/' . $book->id,
        ["author" => "Petrov Alexey", 'count' => 500, 'price' => 9000])
        ->assertStatus(400);
    assertDatabaseMissing('books', ["id" => $book->id, "author" => "Petrov Alexey", 'count' => 500, 'price' => 9000]);
});
