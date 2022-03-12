<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{

    public function index()
    {
        return response()->json([
            'data' => Ingredient::all(),
        ]);
    }

}
