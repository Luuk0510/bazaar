@props(['review'])

<div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md dark:text-gray-300">
    <div class="flex items-center mb-2">
        <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center  font-bold text-sm">
            {{ substr($review->reviewer->name, 0, 2) }}</div>
        <div class="ml-2 font-semibold ">{{ $review->reviewer->name }}</div>
    </div>
    <h3 class="text-lg font-semibold mb-2">{{ $review->title }}</h3>
    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $review->comment }}</p>
    <div class="flex items-center">
        <div class="flex">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i > $review->rating)
                    <x-icons name="star" color="text-gray-500" />
                @else
                    <x-icons name="star_filled" color="text-yellow-500" />
                @endif
            @endfor
        </div>
    </div>
</div>
