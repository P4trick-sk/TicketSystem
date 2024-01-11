<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Upravovanie odpovede
        </h2>
    </x-slot>

    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form method="POST" enctype="multipart/form-data" action="{{ route('response.update', $response->id) }}">
                @method('patch')
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="response" :value="__('Response')" />
                    <x-text-input id="response" class="block mt-1 w-full" type="text" name="response" :value="$response->response" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('response')" class="mt-2" />
                </div>

                {{--@if($response->attachments)
                    <div class="sm:grid sm:grid-cols-3 gap-4">
                        @foreach(json_decode($response->attachments) as $file)
                            <div>
                                <img src="/{{ $file }}" alt="test" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4">
                    <input class="text-gray-400" type="file" name="attachments[]" id="attachment" multiple>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>--}}

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Upraviť') }}
                    </x-primary-button>
                </div>
            </form>

            <livewire:image-gallery :response="$response" />
        </div>
    </div>
</x-app-layout>
