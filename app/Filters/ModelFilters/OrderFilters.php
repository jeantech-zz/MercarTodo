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
        $this->query->select(['orders.id','user_id','users.name as user_name','customer_name','customer_email','customer_mobile','total', 'currency', 'status'])
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->where('user_id', auth()->user()->id);
        return $this;
    }
}
