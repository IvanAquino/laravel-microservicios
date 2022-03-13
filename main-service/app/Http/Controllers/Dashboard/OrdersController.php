<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateOrderRequest;
use App\Services\KitchenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{

    public function index()
    {
        $service = new KitchenService();

        try {
            $orders = $service->getOrders();
            $orders = $orders['data'];

            return view('dashboard.orders.index', compact('orders'));
        } catch(Exception $e) {
            Log::error($e);
            return redirect()->route('dashboard.services.unavailable');
        }
    }

    public function create()
    {
        $kitchenService = new KitchenService();

        try {
            $recipes = $kitchenService->getRecipes();
            $recipes = $recipes['data'];

            return view('dashboard.orders.create', compact('recipes'));
        } catch(Exception $e) {
            Log::error($e);
            return redirect()->route('dashboard.services.unavailable');
        }
    }

    public function store(CreateOrderRequest $request)
    {
        $kitchenService = new KitchenService();

        try {
            $kitchenService->createOrder(
                $request->recipe_id,
                $request->quantity
            );

            return redirect()
                ->route('dashboard.orders.index')
                ->with('success', __('Order created successfully!'));
        } catch(Exception $e) {
            Log::error($e);
            return redirect()->route('dashboard.services.unavailable');
        }
    }

}
