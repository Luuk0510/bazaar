<x-app-layout>
    <div class="mt-3 flex justify-between items-center mr-2">
        <div class="invisible flex-none ml-2">
            <div
                class="bg-white dark:bg-gray-700 rounded-lg shadow-md transition-transform transform hover:scale-105 flex h-full justify-center items-center dark:text-white">
                <div class="flex flex-row justify-center items-center opacity-0 p-3">
                    <h2 class="pr-4"> {{ __('messages.landing_page_edit') }} </h2>
                    <x-icons name="pencil_square" />
                </div>
            </div>
        </div>

        <div class="flex-grow text-center">
            @if ($landingPage)
                <x-title>
                    <h1 class="text-6xl font-semibold dark:text-white">{{ $landingPage->title }}</h1>
                </x-title>
            @endif
        </div>

        <a href="{{ route('landingpage.edit') }}" class="flex-none mr-2">
            <div
                class="bg-white dark:bg-gray-700 rounded-lg shadow-md transition-transform transform hover:scale-105 flex h-full justify-center items-center dark:text-white">
                <div class="flex flex-row justify-center items-center p-3">
                    <h2 class="pr-4"> {{ __('messages.landing_page_edit') }} </h2>
                    <x-icons name="pencil_square" />
                </div>
            </div>
        </a>
    </div>

    <div class="flex justify-center items-center">
        <div class="flex justify-center">
            @if ($landingPage && $landingPage->image)
                <img style="max-width: 700px; max-height: 500px" class="rounded-lg"
                    src="data:image/jpeg;base64,{{ $landingPage->image }}">
            @endif
        </div>
    </div>

    @if ($landingPage && $landingPage->description)
        <div class="flex justify-center items-center">
            <div class="flex justify-center w-1/2 mb-4">
                <div class="mt-3 p-2 bg-white dark:bg-gray-700 rounded-lg">
                    <p class="dark:text-white">{{ $landingPage->description }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($combinedAdvertisements->isNotEmpty())
        <p class="mt-2 flex items-center justify-center text-2xl dark:text-white">
            {{ __('messages.featured_advertisements') }}</p>
        <div class="max-w-screen-xl mx-auto flex flex-wrap justify-center">
            @foreach ($combinedAdvertisements as $item)
                <div class="w-full sm:w-1/2 md:w-1/3 p-2">
                    @if ($item instanceof App\Models\Advertisement)
                        <x-advertisement-card :advertisement="$item" />
                    @elseif ($item instanceof App\Models\RentalAdvertisement)
                        <x-rental-advertisement-card :rentalAdvertisement="$item" />
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    </div>

</x-app-layout>
