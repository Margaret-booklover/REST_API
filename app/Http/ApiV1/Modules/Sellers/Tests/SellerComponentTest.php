<?php

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

test('GET /api/v1/sellers/{id} 200', function () {
    $seller = Seller::factory()->create();
    getJson('/api/v1/sellers/'.$seller->id)
        ->assertStatus(200)
        ->assertJsonPath('data.id', $seller->id);
});

test('GET /api/v1/sellers/{id} 404', function () {
    $seller = Seller::factory()->create();
    getJson('/api/v1/sellers/'.$seller->id+1)
        ->assertStatus(404);
});

test('DELETE /api/v1/sellers/{id} 200', function () {
    $seller = Seller::factory()->create();
    $id = $seller->id;
    deleteJson('/api/v1/sellers/'.$id)
        ->assertStatus(200)
        ->assertJson(['data' => null]);
    assertDatabaseMissing('sellers',['id' => $id]);
});

test('PATCH all seller fields /api/v1/sellers/{id} 200', function () {
    $seller = Seller::factory()->create();
    patchJson('/api/v1/sellers/'.$seller->id, ["fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $seller->id);
    assertDatabaseHas('sellers', ['id' => $seller->id, "fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"]);
});
test('PATCH seller fio only /api/v1/sellers/{id} 200', function () {
    $seller = Seller::factory()->create();
    patchJson('/api/v1/sellers/'.$seller->id, ["fio" => "Petrov Alexey Petrovich"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $seller->id);
    assertDatabaseHas('sellers', ['id' => $seller->id, "fio" => "Petrov Alexey Petrovich", "phone" => $seller->phone]);
});
test('PATCH phone only /api/v1/sellers/{id} 200', function () {
    $seller = Seller::factory()->create();
    patchJson('/api/v1/sellers/'.$seller->id, ["phone" => "+88005553535"])
        ->assertStatus(200)
        ->assertJsonPath('data.id', $seller->id);
    assertDatabaseHas('sellers', ['id' => $seller->id, "fio" => $seller->fio, "phone" => "+88005553535"]);
});

test('PATCH /api/v1/sellers/{id} 404', function () {
    $seller = Seller::factory()->create();
    patchJson('/api/v1/sellers/'.$seller->id+1, ["fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"])
        ->assertStatus(404);
});

test('POST /api/v1/sellers 201', function () {
    $temp = postJson('/api/v1/sellers', ["fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"])
        ->assertStatus(201);
    assertDatabaseHas('sellers',
        ['id' => $temp->json('data.id'), "fio" => "Petrov Alexey Petrovich", "phone" => "+88005553535"]);
});
