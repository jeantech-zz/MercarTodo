<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\UserNameOrder;
use App\Filters\Filter;
use App\Models\Order;

class OrderFilters extends Filter
{
    protected string $model = Order::class;

    protected array $applicableConditions = [
        'customer_name' => UserNameOrder::class
    ];

    protected function select(): Filter
    {
        $this->query->select(['id','user_id', 'customer_name','customer_email','customer_mobile','total', 'currency', 'status']);
        return $this;
    }
}
