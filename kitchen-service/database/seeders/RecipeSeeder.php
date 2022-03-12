<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = [
            [
                'name' => 'Pizza',
                'instructions' => 'Instructions to make Pizza',
                'ingredients' => [
                    ['name' => 'tomato', 'quantity' => 3],
                    ['name' => 'cheese', 'quantity' => 2],
                    ['name' => 'onion', 'quantity' => 1],
                    ['name' => 'meat', 'quantity' => 2],
                ],
            ],
            [
                'name' => 'Hamburger',
                'instructions' => 'Instructions to make Hamburger',
                'ingredients' => [
                    ['name' => 'meat', 'quantity' => 3],
                    ['name' => 'cheese', 'quantity' => 2],
                    ['name' => 'onion', 'quantity' => 1],
                    ['name' => 'tomato', 'quantity' => 1],
                    ['name' => 'lettuce', 'quantity' => 1],
                    ['name' => 'potato', 'quantity' => 2],
                    ['name' => 'ketchup', 'quantity' => 1],
                ],
            ],
            [
                'name' => 'Beefsteak',
                'instructions' => 'Instructions to make Beefsteak',
                'ingredients' => [
                    ['name' => 'meat', 'quantity' => 1],
                    ['name' => 'raice', 'quantity' => 2],
                    ['name' => 'potato', 'quantity' => 3],
                ],
            ],
            [
                'name' => 'Chicken salad',
                'instructions' => 'Instructions to make Chicken salad',
                'ingredients' => [
                    ['name' => 'chicken', 'quantity' => 2],
                    ['name' => 'raice', 'quantity' => 2],
                    ['name' => 'tomato', 'quantity' => 1],
                    ['name' => 'lettuce', 'quantity' => 1],
                    ['name' => 'onion', 'quantity' => 1],
                    ['name' => 'lemon', 'quantity' => 1],
                ],
            ],
            [
                'name' => 'Fried chicken',
                'instructions' => 'Instructions to make Fried chicken',
                'ingredients' => [
                    ['name' => 'chicken', 'quantity' => 2],
                    ['name' => 'potato', 'quantity' => 2],
                    ['name' => 'ketchup', 'quantity' => 1],
                ],
            ],
            [
                'name' => 'Super dish',
                'instructions' => 'Instructions to make Super dish',
                'ingredients' => [
                    ['name' => 'tomato', 'quantity' => 2],
                    ['name' => 'lemon', 'quantity' => 2],
                    ['name' => 'potato', 'quantity' => 2],
                    ['name' => 'rice', 'quantity' => 2],
                    ['name' => 'ketchup', 'quantity' => 2],
                    ['name' => 'lettuce', 'quantity' => 2],
                    ['name' => 'onion', 'quantity' => 2],
                    ['name' => 'cheese', 'quantity' => 2],
                    ['name' => 'meat', 'quantity' => 2],
                    ['name' => 'chicken', 'quantity' => 2],
                ],
            ],
        ];

        foreach($recipes as $recipe) {
            $recipeModel = Recipe::create([
                'name' => $recipe['name'],
                'instructions' => $recipe['instructions'],
            ]);

            foreach($recipe['ingredients'] as $ingredient) {
                $ingredientModel = Ingredient::where('name', $ingredient['name'])->first();

                $recipeModel->ingredients()->attach($ingredientModel, [
                    'quantity' => $ingredient['quantity'],
                ]);
            }
        }
    }
}
