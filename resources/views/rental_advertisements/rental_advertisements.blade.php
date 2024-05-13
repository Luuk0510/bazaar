<x-app-layout>
    <x-title>
        {{ __('messages.rental_advertisements') }}
    </x-title>
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if (!$rentalAdvertisements || $rentalAdvertisements->isEmpty())
            <p class="dark:text-white">{{ __('messages.no_rental_advertisements') }}</p>
        @else
            @foreach ($rentalAdvertisements as $rentalAdvertisement)
                <x-rental-advertisement-card :rentalAdvertisement="$rentalAdvertisement"/>
            @endforeach
        @endif
    </div>
    <div class="flex justify-center"> 
        <x-pagination :items="$rentalAdvertisements"/>
    </div>
</x-app-layout>