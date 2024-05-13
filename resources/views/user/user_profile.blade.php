<x-app-layout>
    <x-title>
       {{ $user->name }} {{ __('messages.profile') }}
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

        <!-- Review form -->
        <form id="reviewForm" action="{{ route('reviews.storeUserReview') }}" method="POST" class="mt-4">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-8">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <label for="title" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.review_title') }}</span>
                    <x-text-input type="text" name="title" id="title" required autofocus
                        placeholder="{{ __('messages.review_title') }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </label>

                <label for="comment" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.review_description') }}</span>
                    <x-textarea-input name="comment" id="comment" rows="4" required
                        placeholder="{{ __('messages.your_review') }}" />
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </label>

                <label for="stars" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.review_rating') }}</span>
                    <div id="stars" class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" class="star" onclick="rateStar({{ $i }})">
                                <x-icons name="star_filled" color="text-black-500" />
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="starsInput">
                    <x-input-error :messages="$errors->get('stars')" class="mt-2" />
                </label>

                <div class="flex items-center  mt-4">
                    <x-primary-button>
                        {{ __('messages.submit_review') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    function rateStar(value) {
        const stars = document.querySelectorAll('.star');
        stars.forEach((star, index) => {
            if (index < value) {
                star.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-500">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>`;
            } else {
                star.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="text-yellow-500" class="w-6 h-6 text-yellow-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                        </svg>`;
            }
        });
        document.getElementById('starsInput').value = value;
    }
</script>