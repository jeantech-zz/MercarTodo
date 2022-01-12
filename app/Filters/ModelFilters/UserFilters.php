<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\User;

class UserFilters extends Filter
{
    protected string $model = User::class;
    protected array $applicableConditions = [
        'name' => Name::class
    ];

    protected function select(): Filter
    {
        $this->query->select(['id', 'name','email','phone_number','address']);
        return $this;
    }
}
