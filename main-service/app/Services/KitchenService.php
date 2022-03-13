<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class KitchenService
{
    private $serviceUrl;

    public function __construct()
    {
        $this->serviceUrl = env('KITCHEN_SERVICE_URL');
    }

    public function getRecipes(): array
    {
        $serviceToken = env('INTERNAL_COMMUNICATION_TOKEN');

        $response = Http::timeout(3)
            ->withHeaders([
                'X-Internal-Communication-Token' => $serviceToken,
            ])
            ->get($this->serviceUrl . '/api/recipes');

        return $response->throw()->json();
    }

    public function getOrders()
    {
        $serviceToken = env('INTERNAL_COMMUNICATION_TOKEN');

        $response = Http::timeout(3)
            ->withHeaders([
                'X-Internal-Communication-Token' => $serviceToken,
            ])
            ->get($this->serviceUrl . '/api/orders');

        return $response->throw()->json();
    }


    public function createOrder($recipeId, $quantity)
    {
        $serviceToken = env('INTERNAL_COMMUNICATION_TOKEN');

        $response = Http::timeout(3)
            ->withHeaders([
                'X-Internal-Communication-Token' => $serviceToken,
            ])
            ->post($this->serviceUrl . '/api/orders', [
                'recipe_id' => $recipeId,
                'quantity' => $quantity,
            ]);

        return $response->throw()->json();
    }

}
