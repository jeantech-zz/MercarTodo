<?php

namespace App\Inputs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class FileInput extends Input
{
    public function render(?Model $model): View
    {
        return view('partials.inputs.file', ['field' => $this, 'model' => $model]);
    }
}
