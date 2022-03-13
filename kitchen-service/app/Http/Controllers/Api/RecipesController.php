<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{

    public function index()
    {
        return response()->json([
            'data' => Recipe::all(),
        ]);
    }

}
