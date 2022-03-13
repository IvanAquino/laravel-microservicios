<?php

use App\Jobs\IngredientsRequestJob;
use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\withHeaders;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Artisan::call('db:seed', ['--force' => true]);
});

test('Orders api respond with 1 order', function () {
    Order::factory()->create();

    $response = withHeaders([
        'X-Internal-Communication-Token' => env('INTERNAL_COMMUNICATION_TOKEN'),
    ])->getJson('/api/orders');

    $response->assertOk();

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });
});

test('Orders api must create order', function () {
    Bus::fake();

    $recipe = Recipe::inRandomOrder()->first();
    $order = Order::factory()->make([
        'recipe_id' => $recipe->id,
    ]);

    $response = withHeaders([
        'X-Internal-Communication-Token' => env('INTERNAL_COMMUNICATION_TOKEN'),
    ])->postJson('/api/orders', [
        'recipe_id' => $order->recipe_id,
        'quantity' => $order->quantity,
    ]);

    $response->assertOk();
    $response->assertJson(function (AssertableJson $json) {
        $json->has('message');
        $json->has('data');
    });

    assertDatabaseHas('orders', [
        'recipe_id' => $order->recipe_id,
        'quantity' => $order->quantity,
    ]);

    Bus::assertDispatched(IngredientsRequestJob::class);
});
