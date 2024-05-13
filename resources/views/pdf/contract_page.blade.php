<x-app-layout>
    <div class="flex justify-center mt-8">
        <div class="w-1/2">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.contract_upload') }}
                    </h2>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:p-0">
                    <form action="{{ route('upload.contract') }}" method="POST" enctype="multipart/form-data"
                        class="flex items-center space-x-4 p-4">
                        @csrf
                        <x-file-input name="contract" id="contract" accept=".pdf" />
                        <x-input-error :messages="$errors->get('contract')" class="mt-2" />
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded-md">{{ __('messages.upload') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-8 dark:text-gray-300">
        <div class="w-1/2">
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.contracts') }}</h2>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:p-0">
                    @foreach ($pdfs as $pdf)
                        <div
                            class="flex justify-between items-center px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                            <span>{{ $pdf['name'] }}</span>
                            <a href="{{ route('download.contract', $pdf['name']) }}"
                                class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 rounded-md">{{ __('messages.download') }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
