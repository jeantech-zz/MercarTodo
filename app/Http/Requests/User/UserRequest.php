<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/u' ],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users', 'email')->ignore($this->users)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['string', 'max:255'],
            'address' => ['string', 'max:255' ],
        ];
    }
}
