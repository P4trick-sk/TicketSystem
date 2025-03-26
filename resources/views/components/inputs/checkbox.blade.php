<div class="w-full mb-4">
    <label class="block text-sm font-medium mb-2 dark:text-white">
        {{ $label }}
    </label>
    <div class="grid sm:grid-cols-2 gap-2">
        @foreach ($options as $index => $option)
            <label
                for="{{ $name }}_{{ $index }}"
                class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
            >
                <input
                    wire:model.live="value"
                    type="checkbox"
                    name="{{ $name }}[]"
                    id="{{ $name }}_{{ $index }}"
                    value="{{ $option }}"
                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                >
                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $option }}</span>
            </label>
        @endforeach
    </div>
    @error($name)
        @foreach($errors->get($name) as $message)
            <p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">{{ $message }}</p>
        @endforeach
    @enderror
</div>
