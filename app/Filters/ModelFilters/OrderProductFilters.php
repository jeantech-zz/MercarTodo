<?php

namespace App\Filters\ModelFilters;

use App\Filters\Conditions\UserNameOrder;
use App\Filters\Conditions\OrderProductToOrder;
use App\Filters\Filter;
use App\Models\OrderProduct;

class OrderProductFilters extends Filter
{
    protected string $model = OrderProduct::class;

    protected array $applicableConditions = [
        'customer_name' => UserNameOrder::class,
        'order_id' => OrderProductToOrder::class,        
    ];

    protected function select(): Filter
    {
        $this->query->select(['order_products.id','product_id', 'order_products.quantity','amount','order_id', 'products.name as products_name', 'products.image as products_image' ])
        ->join('products', 'products.id', '=', 'order_products.product_id');
        return $this;
    }
}
