<?php

namespace App\ViewModels\Users;

use App\Inputs\Input;
use App\Inputs\TextInput;
use App\Inputs\PasswordInput;
use App\Inputs\HiddenInput;
use App\Models\User;
use App\ViewModels\Concerns\HasModel;

class UserEditViewModel extends UserCreateViewModel
{
    use HasModel;

    protected function title(): string
    {
        return trans('users.titles.edit');
    }

    /**
     * @return Input[]
     */
    protected function inputs(): array
    {
        return [
            new HiddenInput(
                trans('users.labels.id'),
                trans('users.inputs.id'), 
                trans('users.message_error.id'),          
                true               
            ),
            new TextInput(
                trans('users.labels.name'),
                trans('users.inputs.name'),
                trans('users.placeholders.name'),  
                trans('users.message_error.name'),          
                true               
            ),
            new TextInput(
                trans('users.labels.email'),
                trans('users.inputs.email'),
                trans('users.placeholders.email'),
                trans('users.message_error.email'),
                true
            ),
            new TextInput(
                trans('users.labels.phone_number'),
                trans('users.inputs.phone_number'),
                trans('users.placeholders.phone_number'),
                trans('users.message_error.phone_number'),
                false
            ),
            new TextInput(
                trans('users.labels.address'),
                trans('users.inputs.address'),
                trans('users.placeholders.address'),
                trans('users.message_error.address'),
                false
            ),  
            new PasswordInput(
                trans('users.labels.password'),
                trans('users.inputs.password'),
                trans('users.placeholders.password'),
                trans('users.message_error.password'),
                false
            ),  
            new PasswordInput(
                trans('users.labels.password_confirmation'),
                trans('users.inputs.password_confirmation'),
                trans('users.placeholders.password_confirmation'),
                trans('users.message_error.password_confirmation'),
                false
            ),            
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => route('users.update', $this->model->id),
        ];
    }
}
