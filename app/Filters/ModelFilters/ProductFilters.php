<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\Name;
use App\Filters\Filter;
use App\Models\Product;

class ProductFilters extends Filter
{
    protected string $model = Product::class;
    protected array $applicableConditions = [
        'name' => Name::class
    ];

    protected function select(): Filter
    {
        $this->query->select(['id','code', 'name','description','price','quantity', 'image'])
        ->where('disable_at',null);
        return $this;
    }
}
