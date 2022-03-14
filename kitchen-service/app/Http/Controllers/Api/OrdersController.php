<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Jobs\IngredientsRequestJob;
use App\Models\Order;
use App\Models\Recipe;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::with('recipe')
            ->latest()
            ->get();

        return response()->json([
            'data' => $orders,
        ]);
    }

    public function create(CreateOrderRequest $request)
    {
        $recipe = Recipe::findOrFail($request->recipe_id);

        $order = Order::create([
            'recipe_id' => $recipe->id,
            'quantity' => $request->quantity,
            'status' => Order::STATUS_PENDING,
        ]);

        $ingredientList = $recipe->ingredients
            ->map(function ($ingredient) use($order) {
                return [
                    'name' => $ingredient->name,
                    'quantity' => $ingredient->ingredient_recipe->quantity * $order->quantity,
                ];
            })->toArray();

        IngredientsRequestJob::dispatch($order->id, $ingredientList)
            ->onQueue(env('WAREHOUSE_QUEUE'));

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order,
        ]);
    }

}
