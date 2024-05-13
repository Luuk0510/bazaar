@props(['items'])

<nav class="flex items-center gap-x-1 my-8">
    @if ($items->onFirstPage())
        <button type="button"
            class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 opacity-50 cursor-not-allowed dark:text-white dark:opacity-50"
            disabled>
            <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
            <span>{{ __('messages.previous') }}</span>
        </button>
    @else
        <a href="{{ $items->previousPageUrl() }}"
            class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
            <span>{{ __('messages.previous') }}</span>
        </a>
    @endif


    <div class="flex items-center gap-x-1">
        @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
            <a href="{{ $url }}"
                class="min-h-[38px] min-w-[38px] flex justify-center items-center {{ $items->currentPage() == $page ? 'bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-600 dark:text-white dark:focus:bg-gray-500' : 'text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10' }}" 
                aria-current="{{ $items->currentPage() == $page ? 'page' : '' }}">{{ $page }}</a>
        @endforeach
    </div>

    @if ($items->hasMorePages())
        <a href="{{ $items->nextPageUrl() }}"
            class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <span>{{ __('messages.next') }}</span>
            <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </a>
    @else
        <button type="button"
            class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 opacity-50 cursor-not-allowed dark:text-white dark:opacity-50"
            disabled>
            <span>{{ __('messages.next') }}</span>
        </button>
    @endif
</nav>
