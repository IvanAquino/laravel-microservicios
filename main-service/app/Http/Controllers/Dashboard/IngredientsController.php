<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\WarehouseService;
use Exception;
use Illuminate\Support\Facades\Log;

class IngredientsController extends Controller
{

    public function stock()
    {
        $service = new WarehouseService();

        try {
            $ingredients = $service->getIngredientsStock();
            $ingredients = $ingredients['data'];

            return view('dashboard.ingredients.stock', compact('ingredients'));
        } catch(Exception $e) {
            Log::info($e);
            return redirect()->route('dashboard.services.unavailable');
        }
    }

}
