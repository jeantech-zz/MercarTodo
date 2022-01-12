    
<b-field label="{{ $field->label }}"
    horizontal>
    <b-input
        type="file"
        accept="image/*"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        {{ $field->required ? 'required' : '' }}
        value="{{ old($field->name, $model->{$field->name} ?? '') }}">
    </b-input>
</b-field>
