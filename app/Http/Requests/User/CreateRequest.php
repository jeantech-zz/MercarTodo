<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;


class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/u' ],
            'email' => ['required', 'email','max:255',  Rule::unique('users', 'email')->ignore($this->users)],
            'phone_number' => ['string', 'max:255'],
            'address' => ['string', 'max:255' ],
            'password' => ['required', Rules\Password::defaults()],
         ];
    }
}
