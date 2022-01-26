<?php

namespace App\Actions\OrderProduct;

use App\Actions\Order\UpdateOrderActions;
use App\Models\OrderProduct;
use App\Models\Order;


class addOrderProductActions
{
    public static function execute(OrderProduct $orderProduct)
    {
        $addQuantity = $orderProduct->quantity + 1;

        $orderProduct = OrderProduct::select('order_products.*','products.price As price')
        ->join('products', 'products.id', '=', 'order_products.product_id')
        ->Where('order_products.id', $orderProduct->id )->first();

        $addQuantity = $orderProduct->quantity + 1;
        $addAmount = $orderProduct->amount + $orderProduct->price;

        $orderProduct->update([ 
            'quantity' => $addQuantity,
            'amount' =>  $addAmount
        ]);

        $order = Order::find($orderProduct->order_id);

        $orderUpdate = UpdateOrderActions::execute($order);

        return  $orderProduct;
       
    }
}
