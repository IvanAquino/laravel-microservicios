<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngredientsReadyForOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $ingredients;
    private $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId, $ingredients)
    {
        $this->orderId = $orderId;
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::find($this->orderId);
        if ($order) {
            $order->status = Order::STATUS_PROCESSING;
            $order->save();

            // SIMULATE PROCESSING TIME
            sleep(30);

            $order->status = Order::STATUS_DELIVERED;
            $order->save();
        }
    }
}
