<x-app-layout>
    <x-title>
        {{ __('My Rental Advertisements') }}
    </x-title>
    <div class="max-w-screen-xl mx-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('messages.advertisements') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('messages.creation_date') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('messages.price') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('messages.details') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @if (!$rentalAdvertisements || $rentalAdvertisements->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('messages.no_advertisements_on_account') }}
                    </td>
                </tr>
                @else
                    @foreach ($rentalAdvertisements as $rentalAdvertisement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="data:image/jpeg;base64,{{ $rentalAdvertisement->image }}"
                                            alt="advertisementimg">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $rentalAdvertisement->title }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $rentalAdvertisement->category->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $rentalAdvertisement->created_at->toDateString() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $rentalAdvertisement->price }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <a href="{{ route('rental-advertisements.details', ['slug' => $rentalAdvertisement->slug]) }}"
                                    class="text-indigo-600 hover:text-indigo-900">{{ __('messages.details')}}</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="flex justify-center"> 
            <x-pagination :items="$rentalAdvertisements"/>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('rental-advertisements.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('messages.create') }}</a>
        </div>
    </div>
</x-app-layout>
