<x-app-layout>
    <x-title>
        {{ __('messages.agenda') }}
    </x-title>

    <div class="flex flex-col items-center min-h-screen bg-gray-100 dark:bg-gray-800">
        <h2 class="text-lg font-semibold mt-8 mb-4 dark:text-gray-200">{{ __('Week van') }}
            {{ $weekStart->format('d-m-Y') }}</h2>

        <table
            class="w-full max-w-7xl mx-auto table-auto bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden min-h-full">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700">
                    @foreach (range(0, 6) as $day)
                        <th class="px-6 py-3">
                           {{ __('messages.day_' . strtolower(now()->startOfWeek()->addDays($day)->format('l'))) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach (range(0, 6) as $day)
                        <td class="border px-6 py-3 dark:text-gray-300 ">
                            <div class="flex flex-col items-center justify-center min-h-40">
                                @hasanyrole('admin|particulier|zakelijk')
                                    @foreach ($advertisements as $advertisement)
                                        @if ($advertisement->expire_date->format('Y-m-d') === $weekStart->copy()->addDays($day)->format('Y-m-d'))
                                            <div class="bg-blue-200 dark:bg-gray-700 rounded-md p-2 mb-2">
                                                <p class="text-blue-800 dark:text-gray-200">{{ $advertisement->title }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach ($rentalsFromAdvertisements as $rental)
                                        @if ($rental->start_date->format('Y-m-d') === $weekStart->copy()->addDays($day)->format('Y-m-d'))
                                            <div class="bg-green-200 dark:bg-gray-700 rounded-md p-2 mb-2">
                                                <p class="text-blue-800 dark:text-gray-200">
                                                    {{ $rental->rentalAdvertisement->title }}</p>
                                            </div>
                                        @elseif ($rental->end_date->format('Y-m-d') === $weekStart->copy()->addDays($day)->format('Y-m-d'))
                                            <div class="bg-red-200 dark:bg-gray-700 rounded-md p-2 mb-2">
                                                <p class="text-blue-800 dark:text-gray-200">
                                                    {{ $rental->rentalAdvertisement->title }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @endhasanyrole

                                @role('standaard')
                                    @foreach ($rentals as $rental)
                                        @if ($rental->start_date->format('Y-m-d') === $weekStart->copy()->addDays($day)->format('Y-m-d'))
                                            <div class="bg-green-200 dark:bg-gray-700 rounded-md p-2 mb-2">
                                                <p class="text-blue-800 dark:text-gray-200">
                                                    {{ $rental->rentalAdvertisement->title }}</p>
                                            </div>
                                        @elseif ($rental->end_date->format('Y-m-d') === $weekStart->copy()->addDays($day)->format('Y-m-d'))
                                            <div class="bg-red-200 dark:bg-gray-700 rounded-md p-2 mb-2">
                                                <p class="text-blue-800 dark:text-gray-200">
                                                    {{ $rental->rentalAdvertisement->title }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @endrole
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <div class="mt-4 text-gray-600 dark:text-gray-400 text-sm">
            <p class="mb-1">Kleurcodes:</p>
            <ul>
                <li class="mb-1 flex items-center">
                    <span class="bg-green-200 dark:bg-gray-700 rounded-full w-4 h-4 mr-2"></span>
                    <span>Begin van huurperiode van huuradvertentie</span>
                </li>
                <li class="mb-1 flex items-center">
                    <span class="bg-red-200 dark:bg-gray-700 rounded-full w-4 h-4 mr-2"></span>
                    <span>Einde van huurperiode van huuradvertentie</span>
                </li>
                @hasanyrole('admin|particulier|zakelijk')
                <li class="mb-1 flex items-center">
                    <span class="bg-blue-200 dark:bg-gray-700 rounded-full w-4 h-4 mr-2"></span>
                    <span>Einde van veiling</span>
                </li>
                @endhasanyrole
            </ul>
        </div>
        

        <div class="mt-8 mb-4">
            <a href="{{ route('agenda.index', ['week' => now()->format('Y-m-d')]) }}"
                class="mr-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-gray-600 dark:hover:bg-gray-700">{{ __('Today') }}</a>
            <a href="{{ route('agenda.index', ['week' => $weekStart->copy()->subWeek()->format('Y-m-d')]) }}"
                class="mr-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-gray-600 dark:hover:bg-gray-700">{{ __('Vorige week') }}</a>
            <a href="{{ route('agenda.index', ['week' => $weekStart->copy()->addWeek()->format('Y-m-d')]) }}"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-gray-600 dark:hover:bg-gray-700">{{ __('Volgende week') }}</a>
        </div>
    </div>
</x-app-layout>
