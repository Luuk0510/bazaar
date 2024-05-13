<x-app-layout>
    <x-title>
        {{ __('messages.favorites') }}
    </x-title>
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if (!$advertisements || $advertisements->isEmpty())
        <div class="flex items-center justify-center h-64 bg-gray-200 rounded-lg shadow-md">
            <p class="text-lg text-gray-600">{{ __('messages.no_favorites') }}</p>
        </div>
        @else
            @foreach ($advertisements as $item)
                @if ($item instanceof App\Models\Advertisement)
                    <x-advertisement-card :advertisement="$item"/>
                @elseif ($item instanceof App\Models\RentalAdvertisement)
                    <x-rental-advertisement-card :rentalAdvertisement="$item"/>
                @endif
            @endforeach
        @endif
    </div>
    
</x-app-layout>