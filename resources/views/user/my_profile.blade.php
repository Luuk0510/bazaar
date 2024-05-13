<x-app-layout>
    <x-title>
        {{ __('messages.my_profile') }}
    </x-title>
    <div class="max-w-4xl dark:bg-gray-700 mx-auto px-4 py-8 bg-white shadow-lg rounded-lg ">

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
</x-app-layout>

