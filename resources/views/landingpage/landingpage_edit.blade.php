<x-app-layout>
    <div class="flex justify-between items-center mr-2">
        <div class="flex-grow text-center">
            <x-title>
                {{ __('messages.landing_page_edit') }}
            </x-title>
        </div>
    </div>

    <div class="xl:w-1/3 sm:w-full mx-auto p-4 bg-slate-50 dark:bg-gray-700 rounded-lg">
        @if ($errors->any())
            <div class="alert alert-danger dark:text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('landingpage.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-10">
                <x-input-label for="company_name" :value="__('messages.company_name') . ' (' . __('messages.required') . ')'" />
                <p class="text-black dark:text-white">{{ __('messages.company_name_description') }}</p>
                <x-text-input id="company_name" name="company_title_name" type="text"
                    value="{{ old('company_title_name', $landingPage->title ?? '') }}"
                    class="mt-1 block xl:w-2/3 sm:w-full" maxlength="50" />
            </div>

            <div class="mb-10">
                <x-input-label for="custom_url" :value="__('messages.custom_url') . ' (' . __('messages.required') . ')'" />
                <p class="text-black dark:text-white">{{ __('messages.custom_url_description') }}</p>
                <x-text-input id="custom_url" name="custom_url" type="text"
                    value="{{ old('custom_url', $landingPage->customUrl ?? '') }}"
                    class="mt-1 block xl:w-2/3 sm:w-full" maxlength="50" />
            </div>

            <div class="mb-10">
                <x-input-label for="image" :value="__('messages.image')" />
                <p class="text-black dark:text-white">{{ __('messages.image_description') }}</p>
                @if ($landingPage && $landingPage->image)
                    <img src="data:image/jpeg;base64,{{ $landingPage->image }}"
                        style="max-width: 100px; max-height: 100px;" alt="Current Image">
                @endif
                <x-file-input name="image" id="image" required placeholder="{{ __('messages.image') }}" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mb-10">
                <x-input-label for="introduction" :value="__('messages.introduction')" />
                <p class="text-black dark:text-white">{{ __('messages.introduction_description') }}</p>
                <x-textarea-input id="introduction" name="introduction"
                    class="block w-full">{{ old('introduction', $landingPage->description ?? '') }}
                </x-textarea-input>
            </div>
            

            <div class="mb-10">
                <x-input-label for="featured_advertisements" :value="__('messages.featured_advertisements')" />
                @if ($advertisements && $advertisements->isNotEmpty())
                    <p class="text-black dark:text-white">{{ __('messages.featured_advertisements_description') }}</p>
                    <ul class="max-w-sm flex flex-col">
                        @foreach ($advertisements as $advertisement)
                            <x-checkbox-list-input :advertisementItem="$advertisement" :is-checked="$landingPage && $landingPage->advertisements->contains($advertisement)" />
                        @endforeach
                    </ul>
                @else
                    <p class="text-black dark:text-white">{{ __('messages.no_advertisemets') }}</p>
                @endif
            </div>

            <div class="mb-10">
                <x-input-label for="featured_rental_advertisements" :value="__('messages.featured_rental_advertisements')" />
                @if ($rentalAdvertisements && $rentalAdvertisements->isNotEmpty())
                    <p class="text-black dark:text-white">{{ __('messages.featured_Rental_advertisements_description') }}</p>
                    <ul class="max-w-sm flex flex-col">
                        @foreach ($rentalAdvertisements as $rentalAdvertisement)
                            <x-checkbox-list-input :advertisementItem="$rentalAdvertisement" :is-checked="$landingPage && $landingPage->advertisements->contains($advertisement)" />
                        @endforeach
                    </ul>
                @else
                    <p class="text-black dark:text-white">{{ __('messages.no_rental_advertisemets') }}</p>
                @endif
            </div>

            <div class="mb-10">
                <x-input-label for="colors" :value="__('messages.select_background_color')" />
                <p class="text-black dark:text-white">{{ __('messages.select_background_color_description') }}</p>
                <div class="xl:w-1/3 sm:w-full">
                    <ul class="max-w-sm flex flex-col">
                        <li
                            class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5">
                                    <input id="color_0" name="color_id" type="radio"
                                        class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                        value=""
                                        {{ is_null(optional($landingPage)->color_id) ? 'checked' : '' }}>
                                </div>
                                <label for="color_0" class="ms-3 block w-full text-sm dark:text-white">
                                    {{ __('messages.standard_color') }}
                                </label>
                            </div>
                        </li>
                        @foreach ($colors as $color)
                            <x-radio-list-input :color="$color" :is-checked="isset($landingPage->color_id) && $landingPage->color_id == $color->id" />
                        @endforeach

                    </ul>
                </div>
            </div>

            <x-primary-button>{{ __('message.save') }}</x-primary-button>
        </form>
    </div>

</x-app-layout>
