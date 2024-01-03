@props(['categoryTypes', 'selectedId' => null])
<div>
    <x-input-label for="category_id" :value="__('Kategória')" />
    <div class="mt-2">
        <select id="category_id" name="category_id" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            <option selected="true" disabled="disabled">Vyberte</option>
            @foreach($categoryTypes as $type)
                @if($type->categories->first())
                    <optgroup label="{{ $type->name }}">
                        @foreach($type->categories as $category)
                            <option {{$category->id == $selectedId ? 'selected' : null}} value="{{$category->id}}" >{{ $category->name }}</option>
                        @endforeach
                    </optgroup>
                @endif
            @endforeach
        </select>
    </div>
</div>
