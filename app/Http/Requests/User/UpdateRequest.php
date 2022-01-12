<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/u' ],
            'email' => ['required', 'email','max:255'],
            'phone_number' => ['string', 'max:255'],
            'address' => ['string', 'max:255' ],
            'password' => ['confirmed'],
        ];
    }
}
