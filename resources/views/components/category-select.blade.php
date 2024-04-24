@props(['categoryTypes', 'selectedId' => null])
<div>
    <div class="form-group">
        <label class="form-label">{{ __('Kategória') }}:</label>
        <select class="form-select" id="category_id" name="category_id" autocomplete="off" required aria-label="select example">
            <option selected="selected" disabled="disabled">{{ __('Vyberte') }}</option>
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
