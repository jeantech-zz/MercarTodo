<?php

namespace App\Filters\Conditions;

use App\Filters\Condition;
use App\Filters\Criteria;
use Illuminate\Database\Eloquent\Builder;

class OrderProductToOrder extends Condition
{
    public static function append(Builder $query, Criteria $criteria): void
    {
        $query->where('order_id', 'like', "%{$criteria}%");
    }
}
