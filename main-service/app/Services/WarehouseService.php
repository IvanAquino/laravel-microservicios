<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WarehouseService
{
    private $serviceUrl;

    public function __construct()
    {
        $this->serviceUrl = env('WAREHOUSE_SERVICE_URL');
    }

    public function getIngredientsStock()
    {
        $serviceToken = env('INTERNAL_COMMUNICATION_TOKEN');

        $response = Http::timeout(3)
            ->withHeaders([
                'X-Internal-Communication-Token' => $serviceToken,
            ])
            ->get($this->serviceUrl . '/api/ingredients');

        return $response->throw()->json();
    }

    public function getPurchasesByIngredient(string $ingredient)
    {
        $serviceToken = env('INTERNAL_COMMUNICATION_TOKEN');

        $response = Http::timeout(3)
            ->withHeaders([
                'X-Internal-Communication-Token' => $serviceToken,
            ])
            ->get($this->serviceUrl . '/api/purchases/' . $ingredient);

        return $response->throw()->json();
    }
}
