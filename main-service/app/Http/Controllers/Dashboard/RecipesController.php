<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\KitchenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecipesController extends Controller
{

    public function index()
    {
        $service = new KitchenService();

        try {
            $recipes = $service->getRecipes();
            $recipes = $recipes['data'];

            return view('dashboard.recipes.index', compact('recipes'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('dashboard.services.unavailable');
        }
    }

}
