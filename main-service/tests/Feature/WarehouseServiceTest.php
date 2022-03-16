<?php

use App\Services\WarehouseService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

test('WarehouseService getIngredientsStock must return 1 ingredient', function () {
    $serviceUrl = env('WAREHOUSE_SERVICE_URL');
    $fakeResponse = [
        'data' => [
            [
                'id' => 1,
                'name' => 'tomato',
                'quantity' => 1,
            ],
        ],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeResponse, 200),
    ]);

    $warehouseService = new WarehouseService();
    $ingredients = $warehouseService->getIngredientsStock();

    $this->assertTrue(isset($ingredients['data']));
    $this->assertCount(1, $ingredients['data']);
    $this->assertEquals('tomato', $ingredients['data'][0]['name']);
});

test('WarehouseService getIngredientsStock must throw exception when response fails', function () {
    $serviceUrl = env('WAREHOUSE_SERVICE_URL');
    $fakeResponse = [
        'message' => 'Server error',
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeResponse, 500),
    ]);

    $warehouseService = new WarehouseService();
    expect(fn() => $warehouseService->getIngredientsStock())
        ->toThrow(RequestException::class);
});

test('WarehouseService getPurchasesByIngredient must return 1 ingredient purchase', function () {
    $serviceUrl = env('WAREHOUSE_SERVICE_URL');
    $fakeResponse = [
        'data' => [
            [
                'id' => 1,
                'quantity' => 1,
            ],
        ],
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeResponse, 200),
    ]);

    $warehouseService = new WarehouseService();
    $ingredients = $warehouseService->getPurchasesByIngredient('tomato');

    $this->assertTrue(isset($ingredients['data']));
    $this->assertCount(1, $ingredients['data']);
});

test('WarehouseService getPurchasesByIngredient must throw exception when response fails', function () {
    $serviceUrl = env('WAREHOUSE_SERVICE_URL');
    $fakeResponse = [
        'message' => 'Server error',
    ];

    Http::fake([
        $serviceUrl . '*' => Http::response($fakeResponse, 500),
    ]);

    $warehouseService = new WarehouseService();
    expect(fn() => $warehouseService->getPurchasesByIngredient('tomato'))
        ->toThrow(RequestException::class);
});
