<li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
    <div class="relative flex items-start w-full">
        <div class="flex items-center h-5">
            <input id="advertisement_{{ $advertisementItem->id }}"
                   name="advertisements[]"
                   type="checkbox"
                   value="{{ $advertisementItem->id }}"
                   class="border-gray-200 rounded disabled:opacity-50 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                   {{ $attributes->get('is-checked') ? 'checked' : '' }}>
        </div>
        <label for="advertisement_{{ $advertisementItem->id }}"
               class="ms-3.5 block w-full text-sm text-gray-600 dark:text-white">
            {{ $advertisementItem->title }}
        </label>
    </div>
</li>
  