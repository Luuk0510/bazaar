<x-app-layout>
    <x-title>
        {{ __('My Advertisements') }}
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
                        {{ __('messages.expiration_date') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Details') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @if (!$advertisements || $advertisements->isEmpty())
                    <tr>
                        <td colspan="4"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('messages.no_advertisements_on_account') }}
                        </td>
                    </tr>
                @else
                    @foreach ($advertisements as $advertisement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="data:image/jpeg;base64,{{ $advertisement->image }}"
                                            alt="advertisementimg">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $advertisement->title }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $advertisement->category->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $advertisement->created_at->toDateString() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                @if ($advertisement->isExpired())
                                    <span class="text-red-500">{{ __('messages.expired') }}</span>
                                @else
                                    {{ date('Y-m-d', strtotime($advertisement->expire_date)) }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <a href="{{ route('advertisements.details', ['slug' => $advertisement->slug]) }}"
                                    class="text-indigo-600 hover:text-indigo-900">{{ __('messages.details') }}</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="flex justify-center"> 
            <x-pagination :items="$advertisements"/>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('advertisements.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('messages.create') }}</a>
        </div>
        @hasanyrole('admin|zakelijk')
        <div class="mt-8 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.csv_upload') }}</h2>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:p-0">
                <form action="{{ route('advertisements.createWithCSV') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center space-x-4 p-4">
                    @csrf
                    <x-file-input id="csv_file" name="csv_file" accept=".csv" />
                    <x-input-error :messages="$errors->get('csv_file')" class="mt-2" />
                    <x-primary-button>{{ __('Upload') }}</x-button>
                </form>
            </div>
        </div>
        @endhasanyrole
    </div>
</x-app-layout>
