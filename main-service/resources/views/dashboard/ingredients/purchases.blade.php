<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchases of :ingredient', ['ingredient' => $ingredient]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($purchases as $purchase)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 p-6">
                <h2 class="text-lg font-bold">
                    {{ __('Quantity: :quantity',['quantity' => $purchase['quantity']]) }}
                </h2>
                <p class="text-right mt-2">
                    {{ substr($purchase['created_at'], 0, 19) }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
