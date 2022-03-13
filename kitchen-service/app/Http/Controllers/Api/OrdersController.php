<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
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

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order,
        ]);
    }

}
