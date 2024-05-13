<x-app-layout>
    <x-title>
        {{ __('messages.detail_rental_advertisement') }}
    </x-title>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex">
                        <div class="w-1/2 pr-4">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
                                <div class="mt-4 flex justify-between items-center">
                                    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ $rentalAdvertisement->title }}</h1>
                                </div>
                                <div class="text-gray-600 dark:text-gray-400">
                                    <b>{{ __('categories.' . $rentalAdvertisement->category->name . '') }}</b>
                                </div>

                                <img src="data:image/jpeg;base64,{{ $rentalAdvertisement->image }}" alt="Afbeelding"
                                    class="w-full h-auto object-cover rounded-lg">

                                <div class="mt-4 flex justify-between items-center">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ __('messages.description') }}</h3>
                                </div>

                                <p class="text-gray-700 dark:text-gray-300 mt-4">{{ $rentalAdvertisement->description }}
                                </p>
                            </div>
                        </div>
                        <div class="w-1/2 pl-4">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
                                <div class="mt-4 flex justify-between items-center">
                                    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ __('messages.price') }}</h1>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mt-4">€ {{ $rentalAdvertisement->price }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <!-- Reviews -->
                <h2 class="text-2xl font-semibold mb-4 dark:text-white">{{ __('messages.reviews') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if ($reviews && $reviews->isNotEmpty())
                        @foreach ($reviews as $review)
                            <x-review-card :review="$review" />
                        @endforeach
                    @else
                        <p class="text-gray-500 dark:text-gray-400">{{ __('messages.no_reviews') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
