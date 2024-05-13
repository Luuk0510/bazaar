@props(['name', 'label'])

<label for="{{ $name }}" class="block">
    <span class="text-gray-700 dark:text-gray-300">{{ $label }}</span>
    <div class="relative">
        <input type="text" id="{{ $name }}" name="{{ $name }}"
               class="py-3 px-4 ps-9 pe-20 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
               placeholder="0.00">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
            <span class="text-gray-500">€</span>
        </div>
    </div>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</label>
