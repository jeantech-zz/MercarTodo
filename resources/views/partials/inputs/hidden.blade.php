
<b-input
    type="hidden"
    id="{{ $field->name }}"
    name="{{ $field->name }}"
    {{ $field->required ? 'required' : '' }}
    value="{{ old($field->name, $model->{$field->name} ?? '') }}">
</b-input>

