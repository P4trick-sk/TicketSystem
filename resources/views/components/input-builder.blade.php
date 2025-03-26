<div>
    @foreach ($fields as $field)
        @php
            $fieldLabel = ucfirst(str_replace('_', ' ', $field['field_name']));
            $options = json_decode($field['options'], true) ?? [];
        @endphp

        @if ($field['field_type'] === 'text')
            <x-inputs.text :name="$field['field_name']" :label="$fieldLabel" :required="$field['is_required']" />
        @elseif ($field['field_type'] === 'textarea')
            <x-inputs.textarea :name="$field['field_name']" :label="$fieldLabel" :required="$field['is_required']" />
        @elseif ($field['field_type'] === 'select')
            <x-inputs.select :name="$field['field_name']" :label="$fieldLabel" :options="$options" :required="$field['is_required']" />
        @elseif ($field['field_type'] === 'checkbox')
            <x-inputs.checkbox :name="$field['field_name']" :label="$fieldLabel" :options="$options" />
        @elseif ($field['field_type'] === 'radio')
            <x-inputs.radio :name="$field['field_name']" :label="$fieldLabel" :options="$options" :required="$field['is_required']" />
        @endif
    @endforeach
</div>
