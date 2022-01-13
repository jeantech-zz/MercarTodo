    
<b-field label="{{ $field->label }}"
    horizontal
    message="{{ $errors->first( $field->name ) }}"
    >
    <b-input
        type="file"
        accept="image/*"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        {{ $field->required ? 'required' : '' }}>
    </b-input>
</b-field>
