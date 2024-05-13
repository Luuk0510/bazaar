<a href="{{ route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]) }}">
    <div
        class="bg-white dark:bg-gray-700 rounded-lg shadow-md transition-transform transform hover:scale-105 flex flex-col h-full relative">
        <img src="data:image/jpeg;base64, {{ $rentalAdvertisement->image }}" alt="Advertentie afbeelding"
            class="w-full h-48 object-cover rounded-t-lg" />
        <div class="p-4 flex-grow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $rentalAdvertisement->title }}</h2>
            <p class="text-gray-600 dark:text-gray-300">
                <b>{{ __('categories.' . $rentalAdvertisement->category->name) }}</b>
            </p>
            <p class="text-gray-600 dark:text-gray-300 line-clamp-5 break-all">{{ $rentalAdvertisement->excerpt }}</p>
        </div>
        <div class="absolute top-0 left-0 px-3 py-1 m-2 z-10">
            <form method="POST" action="{{ route('favorites.toggle-rental-advertisement') }}">
                @csrf
                <input type="hidden" name="rental_advertisement_id" value="{{ $rentalAdvertisement->id }}">
                <button class="text-gray-800 dark:text-white font-semibold transform hover:scale-125">
                    @if ($rentalAdvertisement->isFavorite(auth()->user()))
                        <x-icons name='star_filled' color="text-yellow-500"/>
                    @else
                        <x-icons name='star' />
                    @endif
                </button>
            </form>
        </div>
        <div class="flex justify-left items-center p-4">
            {{ $rentalAdvertisement->qrCode }}
        </div>
        <div class="absolute top-0 right-0 bg-white dark:bg-gray-700 rounded-full px-3 py-1 m-2 shadow-md">
            <span
                class="text-gray-800 dark:text-white font-semibold">{{ '€ ' . $rentalAdvertisement->price . '/ ' . __('messages.day') }}</span>
        </div>
    </div>
</a>
