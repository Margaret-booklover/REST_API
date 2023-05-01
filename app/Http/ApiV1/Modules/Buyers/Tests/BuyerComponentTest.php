<?php

use App\Domain\Buyers\Models\Buyer;
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

test('GET /api/v1/buyers/{id} 200', function () {
    $buyer = Buyer::factory()->create();
    getJson('/api/v1/buyers/'.$buyer->id)
        ->assertStatus(200)
        ->assertJsonPath('data.id', $buyer->id);
});

test('GET /api/v1/buyers/{id} 404', function () {
    $buyer = Buyer::factory()->create();
    getJson('/api/v1/buyers/'.$buyer->id+1)
        ->assertStatus(404);
});

test('DELETE /api/v1/buyers/{id} 200', function () {
    $buyer = Buyer::factory()->create();
    $id = $buyer->id;
    deleteJson('/api/v1/buyers/'.$id)
        ->assertStatus(200)
        ->assertJson(['data' => null]);
    assertDatabaseMissing('buyers',['id' => $id]);
});

test('PATCH all fields /api/v1/buyers/{id} 200', function () {
    $buyer = Buyer::factory()->create();
    patchJson('/api/v1/buyers/'.$buyer->id, ["fio" => "Petrov Alexey Petrovich", "status" => "Director"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $buyer->id);
    assertDatabaseHas('buyers', ['id' => $buyer->id, "fio" => "Petrov Alexey Petrovich", "status" => "Director"]);
});
test('PATCH fio only /api/v1/buyers/{id} 200', function () {
    $buyer = Buyer::factory()->create();
    patchJson('/api/v1/buyers/'.$buyer->id, ["fio" => "Petrov Alexey Petrovich"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $buyer->id);
    assertDatabaseHas('buyers', ['id' => $buyer->id, "fio" => "Petrov Alexey Petrovich", "status" => $buyer->status]);
});
test('PATCH status only /api/v1/buyers/{id} 200', function () {
    $buyer = Buyer::factory()->create();
    patchJson('/api/v1/buyers/'.$buyer->id, ["status" => "Director"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $buyer->id);
    assertDatabaseHas('buyers', ['id' => $buyer->id, "fio" => $buyer->fio, "status" => "Director"]);
});

test('PATCH /api/v1/buyers/{id} 404', function () {
    $buyer = Buyer::factory()->create();
    patchJson('/api/v1/buyers/'.$buyer->id+1, ["fio" => "Petrov Alexey Petrovich", "status" => "Director"])
        ->assertStatus(404);
});

test('POST /api/v1/buyers 201', function () {
    $temp = postJson('/api/v1/buyers', ["fio" => "Petrov Alexey Petrovich", "status" => "Director"])
        ->assertStatus(201);
    assertDatabaseHas((new Buyer())->getTable(),
        ['id' => $temp->json('data.id'), "fio" => "Petrov Alexey Petrovich", "status" => "Director"]);
});
