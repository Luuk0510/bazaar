<x-app-layout>

    <x-title>
        {{ __('messages.rental_advertisement_not_found') }}
    </x-title>

    <div class="max-w-4xl dark:bg-gray-700 mx-auto px-4 py-8 bg-white shadow-lg rounded-lg ">
        <p class="text-xl mb-4 dark:text-white">{{ __('messages.rental_advertisement_not_found_description') }}</p>
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if ($similarAdvertisements)
                @foreach ($similarAdvertisements as $rentalAdvertisement)
                <x-rental-advertisement-card :rentalAdvertisement="$rentalAdvertisement" />
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
