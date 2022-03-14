<?php

use App\Models\Ingredient;
use App\Models\Purchase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\withHeaders;

beforeEach(function () {
    Artisan::call('db:seed', ['--force' => true]);
});

test('Ingredients api respond with 1 purchase', function () {
    $ingredient = Ingredient::inRandomOrder()->first();
    Purchase::factory()->create([
        'ingredient_id' => $ingredient->id,
    ]);

    $response = withHeaders([
        'X-Internal-Communication-Token' => env('INTERNAL_COMMUNICATION_TOKEN'),
    ])->getJson('/api/purchases/' . $ingredient->name);


    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        $json->has('data', 1);
    });
});
