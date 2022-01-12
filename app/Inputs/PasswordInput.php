<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class PasswordInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.password', ['field' => $this, 'model' => $model]);
    }
}
