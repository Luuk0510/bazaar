<x-app-layout>

    <x-title>
        {{ __('messages.my_purchase_history') }}
    </x-title>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl dark:text-gray-400 font-semibold mb-4"> {{ __('messages.purchase_history') }}</h2>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('messages.type') }}</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('messages.advertisement_title') }}</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('messages.date') }}</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('messages.price') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 dark:text-gray-400 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($purchaseHistory as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item instanceof App\Models\Bid)
                                            {{ __('messages.bid') }}
                                        @elseif ($item instanceof App\Models\Rental)
                                            {{ __('messages.rental') }}
                                        @endif
                                    </td>
                                    @if ($item instanceof App\Models\Bid)
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->advertisement->title }}</td>
                                    @elseif ($item instanceof App\Models\Rental)
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->title }}</td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ '€ ' . $item->price }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
