<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{

    public function index()
    {
        $recipes = Recipe::with('ingredients')
            ->get();

        return response()->json([
            'data' => $recipes,
        ]);
    }

}
