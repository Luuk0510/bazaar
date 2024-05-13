<x-app-layout>
    <div class="flex justify-center items-center">
        <div class="flex justify-center w-1/2 mb-4">
            <h1 class="mt-3 text-6xl dark:text-white">{{ __('messages.business_registry') }}</h1>
        </div>
    </div>

    <div class="flex justify-center items-center">
        <div class="flex justify-center w-1/2 mb-4">
            <div class="p-4 bg-white dark:bg-gray-700 rounded-lg">
                <ul>
                    @foreach ($businessUsers as $user)
                        <li class="dark:text-white">{{ $user->name }} - {{ $user->email }}
                            <a href="{{ route('generate.contract.pdf', ['userId' => $user->id]) }}"
                                class="m-1 p-2 font-bold text-white bg-gray-600 hover:bg-gray-500 rounded-lg shadow-md">{{ __('messages.generate_contract_pdf') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


</x-app-layout>
