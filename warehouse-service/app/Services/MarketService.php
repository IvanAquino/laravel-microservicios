<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MarketService
{
    private $serviceUrl;

    public function __construct()
    {
        $this->serviceUrl = env('MARKET_SERVICE_URL');
    }

    public function buyIngredient(string $ingredient): int
    {
        $response = Http::timeout(3)->get($this->serviceUrl, [
            'ingredient' => $ingredient
        ]);

        try {
            $purchase = $response->throw()->json();
            return (int) $purchase['quantitySold'];
        } catch(Exception $e) {
            Log::error($e);
            return 0;
        }
    }

}
