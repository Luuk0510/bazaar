<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('auth.register.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('auth.register.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('auth.register.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('auth.register.confirm_password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Roles -->
        <div class="mt-4">
            <x-input-label 
                for="choose_role" 
                class="text-sm text-gray-500 ms-2 dark:text-gray-400"
                :value="__('auth.register.choose_role')"
            />
        </div>

        <div class="ml-2 flex flex-col gap-y-3">
            <div class="flex"> 
                <input 
                    type="radio" 
                    name="choose_role"
                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-vertical-group-1"
                    :id="__('auth.register.default')" 
                    value="standaard"
                    checked
                />
                <x-input-label 
                    :for="__('auth.register.default')"
                    class="text-sm text-gray-500 ms-2 dark:text-gray-400"
                    :value="__('auth.register.default')"
                />
            </div>
            <div class="flex">
                <input 
                    type="radio" 
                    :id="__('auth.register.private_advertiser')"
                    name="choose_role"
                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-vertical-group-1"
                    value="particulier"
                />
                <x-input-label 
                    :for="__('auth.register.private_advertiser')"
                    class="text-sm text-gray-500 ms-2 dark:text-gray-400"
                    :value="__('auth.register.private_advertiser')"
                />
            </div>
            <div class="flex">
                <input 
                    type="radio" 
                    :id="__('auth.register.business_advertiser')"
                    name="choose_role"
                    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-vertical-group-1"
                    value="zakelijk"
                />
                <x-input-label 
                    :for="__('auth.register.business_advertiser')"
                    class="text-sm text-gray-500 ms-2 dark:text-gray-400"
                    :value="__('auth.register.business_advertiser')"
                />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white" href="{{ route('login') }}">
                {{ __('auth.register.already_registered') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('auth.register.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
