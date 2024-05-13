<x-app-layout>
    <x-title>
        {{ __('messages.home') }}
    </x-title>
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if ($latestItems->isEmpty())
            <p>Er zijn geen advertenties!</p>
        @else
            @foreach ($latestItems as $item)
                @if ($item instanceof App\Models\Advertisement)
                    <x-advertisement-card :advertisement="$item"/>
                @elseif ($item instanceof App\Models\RentalAdvertisement)
                    <x-rental-advertisement-card :rentalAdvertisement="$item"/>
                @endif
            @endforeach
        @endif
    </div>
</x-app-layout>
