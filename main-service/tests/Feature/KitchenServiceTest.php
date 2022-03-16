<?php

use App\Services\KitchenService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

test('KitchenService getRecipe must return 1 recipe', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $fakeRecipe = [
        'data' => [
            [
                'id' => 1,
                'name' => 'Recipe 1',
                'instructions' => 'Instructions 1',
                'ingredients' => [],
            ]
        ],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeRecipe, 200),
    ]);

    $kitchenService = new KitchenService();
    $recipes = $kitchenService->getRecipes();

    $this->assertTrue(isset($recipes['data']));
    $this->assertCount(1, $recipes['data']);
});

test('KitchenService getRecipe must throw exception when response fails', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $fakeRecipe = [
        'data' => [
            [
                'id' => 1,
                'name' => 'Recipe 1',
                'instructions' => 'Instructions 1',
                'ingredients' => [],
            ]
        ],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeRecipe, 500),
    ]);

    $kitchenService = new KitchenService();
    expect(fn() => $kitchenService->getRecipes())
        ->toThrow(RequestException::class);
});

test('KitchenService getOrders must return 1 order', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $fakeOrders = [
        'data' => [
            [
                'id' => 1,
                'recipe_id' => 1,
                'quantity' => 1,
            ],
        ],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeOrders, 200),
    ]);

    $kitchenService = new KitchenService();
    $orders = $kitchenService->getOrders();

    $this->assertTrue(isset($orders['data']));
    $this->assertCount(1, $orders['data']);
});


test('KitchenService getOrders must throw exception when response fails', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $fakeOrders = [
        'message' => 'Error',
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeOrders, 500),
    ]);

    $kitchenService = new KitchenService();
    expect(fn() => $kitchenService->getOrders())
        ->toThrow(RequestException::class);
});

test('KitchenService createOrder must respond must return with message and data', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $createOrderResponse = [
        'message' => 'Order created successfully',
        'data' => [],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($createOrderResponse, 200),
    ]);

    $kitchenService = new KitchenService();
    $orders = $kitchenService->getOrders();

    $this->assertTrue(isset($orders['message']));
    $this->assertTrue(isset($orders['data']));
});

test('KitchenService createOrder must throw exception when response fails', function () {
    $serviceUrl = env('KITCHEN_SERVICE_URL');
    $createOrderResponse = [
        'message' => 'Order created successfully',
        'data' => [],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($createOrderResponse, 500),
    ]);

    $kitchenService = new KitchenService();
    expect(fn() => $kitchenService->createOrder(1, 1))
        ->toThrow(RequestException::class);
});

