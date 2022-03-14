<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{

    public function index(string $ingredient)
    {
        $ingredient = Ingredient::where('name', $ingredient)->firstOrFail();

        $purchases = $ingredient
            ->purchases()
            ->latest()
            ->limit(40)
            ->get();

        return response()->json([
            'data' => $purchases,
        ]);
    }

}
