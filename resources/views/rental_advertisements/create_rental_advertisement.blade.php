<x-app-layout>
    <x-title>
        {{ __('messages.create_rental_advertisement') }}
    </x-title>
    <div class="max-w-4xl dark:bg-gray-700 mx-auto px-4 py-8 bg-white shadow-lg rounded-lg ">
        <form method="POST" action="{{ route('rental-advertisements.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-8">
                <label for="title" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.title') }}</span>
                    <x-text-input type="text" name="title" id="title" required autofocus placeholder="{{ __('messages.title') }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </label>

                <label for="category" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.category') }}</span>
                    <x-select name="category" required>
                        <option selected>{{ __('messages.select_category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </label>

                <label for="image" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.image') }}</span>
                    <x-file-input name="image" id="image" required placeholder="{{ __('messages.image') }}" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </label>

                <label for="slug" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.slug') }}</span>
                    <x-text-input name="slug" id="slug" required placeholder="{{ __('messages.slug') }}" />
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                </label>

                <label for="excerpt" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.excerpt') }}</span>
                    <x-text-input name="excerpt" id="excerpt" required placeholder="{{ __('messages.excerpt') }}" />
                    <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                </label>

                <label for="description" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.description') }}</span>
                    <x-textarea-input name="description" required placeholder="{{ __('messages.description') }}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </label>

                <x-price-input name="price" label="{{ __('messages.price') }}" />

                <label for="start_date" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.start_date') }}</span>
                    <x-date-input name="start_date" id="start_date" required placeholder="{{ __('messages.start_date') }}" />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </label>

                <label for="end_date" class="block">
                    <span class="text-gray-700 dark:text-gray-300">{{ __('messages.end_date') }}</span>
                    <x-date-input name="end_date" id="end_date" required placeholder="{{ __('messages.end_date') }}" />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </label>

                <div class="flex items-center justify-begin mt-4">
                    <x-primary-button class="ms-5">
                        {{ __('messages.create') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div> 
</x-app-layout>
