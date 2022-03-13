<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2">
                @foreach($recipes as $recipe)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="p-6 bg-white">
                        <h2 class="font-bold text-lg">{{ $recipe['name'] }}</h2>
                        <p class="mb-3">{{ $recipe['instructions'] }}</p>

                        @foreach($recipe['ingredients'] as $ingredient)
                        <div class="">
                            {{ $ingredient['ingredient_recipe']['quantity'] }}
                            {{ $ingredient['name'] }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
