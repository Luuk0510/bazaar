<x-app-layout>
    <x-title>
        {{ __('messages.detail_advertisement') }}
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
                                    <b>{{ __('categories.' . $advertisement->category->name . '') }}</b>
                                </div>

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
                                </div>
                                <div class="mb-4">
                                    @if ($bids->isEmpty())
                                        <p>{{ __('messages.no_bids') }}</p>
                                    @else
                                        <ul>
                                            @foreach ($advertisement->bids as $bid)
                                                <li>{{ $bid->user->name }} - €{{ $bid->amount }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $reviews = [
            [
                'name' => 'John Doe',
                'rating' => '4/5',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            [
                'name' => 'Jane Smith',
                'rating' => '5/5',
                'comment' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            // Add more hardcoded reviews as needed
        ];
    @endphp
</x-app-layout>
