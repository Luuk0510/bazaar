<x-app-layout>
    <x-title>
        {{ __('messages.advertisements') }}
    </x-title>
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if ($advertisements->isEmpty())
            <p>{{ _('message.no_advertisements') }}</p>
        @else
            @foreach ($advertisements as $advertisement)
                <x-advertisement-card :advertisement="$advertisement"/>
            @endforeach
        @endif
    </div>
    <div class="flex justify-center"> 
        <x-pagination :items="$advertisements"/>
    </div>
</x-app-layout>
