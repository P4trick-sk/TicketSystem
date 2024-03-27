<div>
    <h2 class="text-gray-800 dark:text-gray-200 leading-tight font-semibold text-xl">Prílohy</h2>

    <div class="sm:grid sm:grid-cols-3 gap-4">
        @foreach ($attachments as $index => $image)
            <div>
                <img src="/{{ $image }}" alt="Image {{ $index }}" style="max-height: 200px;object-fit: contain;overflow: hidden;">
                <button class="text-gray-800 dark:text-gray-200 leading-tight" wire:click="deleteImage({{ $index }})">Delete</button>
            </div>
        @endforeach
    </div>

    <form wire:submit="save">
        <div class="mb-3">
            <label for="formFile" class="form-label">Prilohy</label>
            <input class="form-control" type="file" id="formFile" wire:model="uploadedAttachments" multiple>
        </div>

        {{--<input class="text-gray-400" type="file" wire:model="uploadedAttachments" multiple>--}}
        <div><div class="text-gray-400" wire:loading wire:target="uploadedAttachments">Uploading...</div></div>
        @error('uploaded') <span class="error">{{ $message }}</span> @enderror

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Uložiť prílohy') }}
            </x-primary-button>
        </div>
    </form>
</div>
