<?php

use App\Services\MarketService;
use Illuminate\Support\Facades\Http;

test('Market buy ingredient must return integer value 1', function () {
    $marketUrl = env('MARKET_SERVICE_URL');

    Http::fake([
        $marketUrl . "*" => Http::response([
            'quantitySold' => 1,
        ], 200),
    ]);

    $marketService = new MarketService();
    $quantity = $marketService->buyIngredient('tomato');

    $this->assertIsInt($quantity);
    $this->assertEquals(1, $quantity);
});

test('Market buy ingredient must return 0 when market service fails', function () {
    $marketUrl = env('MARKET_SERVICE_URL');

    Http::fake([
        $marketUrl . "*" => Http::response([
            'message' => 'Server error',
        ], 500),
    ]);

    $marketService = new MarketService();
    $quantity = $marketService->buyIngredient('tomato');

    $this->assertIsInt($quantity);
    $this->assertEquals(0, $quantity);
});
