<?php

namespace App\Jobs;

use App\Models\Ingredient;
use App\Services\MarketService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngredientsRequestJob implements ShouldQueue
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
        $ingredientsQuantity = [];
        $marketService = new marketService();

        foreach($this->ingredients as $ingredientData) {
            $ingredient = Ingredient::where('name', $ingredientData['name'])->first();

            if ($ingredient->stock >= $ingredientData['quantity']) {
                $ingredientsQuantity[$ingredient->id] = $ingredientData['quantity'];
                $ingredient->stock -= $ingredientData['quantity'];
                $ingredient->save();
                continue;
            }

            do {
                $quantityPurchased = $marketService->buyIngredient($ingredient->name);

                if ($quantityPurchased > 0) {
                    $ingredient->purchases()->create([
                        'quantity' => $quantityPurchased,
                    ]);
                }

                $ingredient->refresh();
                $ingredient->stock += $quantityPurchased;
                $ingredient->save();
            } while ($ingredient->stock <= $ingredientData['quantity']);

            $ingredientsQuantity[$ingredient->id] = $ingredientData['quantity'];
            $ingredient->stock -= $ingredientData['quantity'];
            $ingredient->save();
        }

        IngredientsReadyForOrderJob::dispatch($this->orderId, $ingredientsQuantity);
    }
}
