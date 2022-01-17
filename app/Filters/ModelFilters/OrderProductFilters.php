<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\UserNameOrder;
use App\Filters\Filter;
use App\Models\OrderProduct;

class OrderProductFilters extends Filter
{
    protected string $model = OrderProduct::class;

    protected array $applicableConditions = [
        'customer_name' => UserNameOrder::class
    ];

    protected function select(): Filter
    {
        $this->query->select(['id','product_id', 'quantity','amount','order_id']);
        return $this;
    }
}
