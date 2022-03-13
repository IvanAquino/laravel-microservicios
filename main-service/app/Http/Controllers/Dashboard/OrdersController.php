<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

}
