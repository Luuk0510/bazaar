<a href="{{ route('advertisements.showBySlug', ['slug' => $advertisement->slug]) }}" class="relative">

    <!-- Advertentiekaart -->
    <div
        class="bg-white dark:bg-gray-700 rounded-lg shadow-md transition-transform transform hover:scale-105 flex flex-col h-full relative">
        <img src="data:image/jpeg;base64,{{  $advertisement->image }}" alt="Advertentie afbeelding" class="w-full h-48 object-cover rounded-t-lg">
        <div class="p-4 flex-grow">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $advertisement->title }}</h2>
            <p class="text-gray-600 dark:text-gray-300">
                <b>{{ __('categories.' . $advertisement->category->name . '') }}</b></p>
            <p class="text-gray-600 dark:text-gray-300 line-clamp-5 break-all">{{ $advertisement->excerpt }}</p>
        </div>
        <div class="absolute top-0 left-0 px-3 py-1 m-2 z-10">
            <form method="POST" action="{{ route('favorites.toggle-advertisement') }}">
                @csrf
                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                <button class="text-gray-800 dark:text-white font-semibold transform hover:scale-125">
                    @if ($advertisement->isFavorite(auth()->user()))
                        <x-icons name='star_filled' color="text-yellow-500" />
                    @else
                        <x-icons name='star' />
                    @endif
                </button>
            </form>
        </div>
        <div class="absolute top-0 right-0 bg-white dark:bg-gray-700 rounded-full px-3 py-1 m-2 shadow-md">
            <span class="text-gray-800 dark:text-white font-semibold">{{ __('messages.auction') }}</span>
        </div>
        <div class="flex justify-left items-center p-4">
            {{ $advertisement->qrCode }}
        </div>
        @if ($advertisement->expire_date != null)
            <div class="p-4 bg-gray-100 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                @if ($advertisement->isExpired())
                    <p class="text-red-500">{{ __('messages.expired_ad_message') }}.</p>
                @else
                    <p class="text-green-500">{{ __('messages.expiry_ad_message') }}:
                        {{ date('Y-m-d', strtotime($advertisement->expire_date)) }}</p>
                @endif
            </div>
        @endif


    </div>

</a>
