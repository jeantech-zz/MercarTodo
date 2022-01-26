<?php

namespace App\Http\Requests\Product;

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
            'code' => [ 'required', 'string', 'max:10', Rule::unique('products', 'code')->ignore($this->products) ],
            'name' => [ 'required', 'string', 'max:88'  ],
            'description' => [ 'required', 'string', 'max:255' ],
            'price' => [ 'required', 'string', 'max:255' ],
            'quantity' => ['required',  'string' , 'max:255'],
            'image' => ['required', 'image','max:1024'   ],
         ];
         //'image' => ['required', 'image','max:1024'   ],
    }
}
