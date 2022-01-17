<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderProduct;

class DeleteOrderActions
{
    public static function execute(Order $order): bool
    {
        $orderProduct = OrderProduct::Where('order_id', $order->id )->first();
        $orderProduct->delete();

        $record = $order->delete();
        
        return $record;
       
    }
}
