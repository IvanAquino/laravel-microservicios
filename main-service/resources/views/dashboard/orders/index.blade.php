<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2">
            @foreach($orders as $order)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-bold">
                        {{ $order['id'] }}.-
                        {{ substr($order['created_at'], 0, 10) }}
                    </h2>
                    <p class="mb-2">
                        {{ $order['quantity'] }} -
                        {{ $order['recipe']['name'] }}
                    </p>
                    <span class="bg-indigo-50 text-indigo-900 px-2 py-2 rounded">
                        {{ ucfirst($order['status']) }}
                    </span>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
