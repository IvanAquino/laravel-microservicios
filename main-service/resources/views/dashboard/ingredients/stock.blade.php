<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($ingredients as $ingredient)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 p-6">
                <h2 class="text-lg font-bold">
                    {{ ucfirst($ingredient['name']) }}
                </h2>
                <div class="text-right">
                    {{ __('In stock:') }}
                    {{ $ingredient['stock'] }}
                </div>
                <div class="text-right">
                    {{ __('Last update:') }}
                    {{ substr($ingredient['updated_at'], 0, 19) }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
