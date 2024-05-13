<x-app-layout>
    <x-title>
        {{ __('messages.advertisement') }}
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
                                        {{ $advertisement->title }}</h1>
                                </div>
                                <div class="text-gray-600 dark:text-gray-400">
                                    <b>{{ __('categories.' . $advertisement->category->name . '') }}</b></div>

                                <img src="data:image/jpeg;base64,{{ $advertisement->image }}" alt="Advertentie afbeelding"
                                    class="w-full h-auto object-cover rounded-lg">

                                <div class="mt-4 flex justify-between items-center">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ __('messages.description') }}</h3>
                                </div>

                                <p class="text-gray-700 dark:text-gray-300 mt-4">{{ $advertisement->description }}</p>
                            </div>
                        </div>
                        <div class="w-1/2 pl-4">
                            <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6">
                               
                                <div class="mt-4 flex justify-between items-center">
                                    <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                                        {{ __('messages.bids') }}</h1>
                                        <div class="text-right dark:text-white">
                                            <a href="{{ route('user-profile', ['userId' => $advertisement->user->id]) }}" class="text-blue-500 hover:underline">{{ $advertisement->user->name }}</a>
                                        </div>
                                </div>
                                <div class="mb-4">
                                    @if ($advertisement->bids->isEmpty())
                                        <p class="dark:text-white">{{ __('messages.no_bids') }}</p>
                                    @else
                                        <ul>
                                            @foreach ($advertisement->bids as $bid)
                                                <li class="dark:text-white">{{ $bid->user->name }} - €{{ $bid->amount }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    @if(!$disableButton)
                                        <form method="POST" action="{{ route('bids.store') }}">
                                            @csrf
                                            <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                                            <x-price-input name="amount" label="{{ __('messages.price') }}" />
                                            <x-input-error :messages="$errors->get('amount')" />
                                            
                                            <x-primary-button class="mt-4">
                                                {{ __('messages.create_bid') }}
                                            </x-primary-button>
                                        </form>
                                    @else
                                        <p> {{ __('messages.maxed_bid') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
