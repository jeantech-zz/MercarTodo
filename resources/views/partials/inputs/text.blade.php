<b-field
    label="{{ $field->label }}"
    horizontal
    type="{{ $errors->has( $field->name  ) ? 'is-danger' : null }}" message="{{ $errors->first( $field->name ) }}"
    >
    <b-input
        type="text"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        {{ $field->required ? 'required' : '' }}
        value="{{ old($field->name, $model->{$field->name}) }}">
    </b-input>
</b-field>


