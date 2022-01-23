<?php

namespace App\Repositories\Orders;

use App\Models\Order;

class ColeccionsOrdersRepositories implements OrdersRepositories
{

    public function requestOrder (int $id)
    {
        
        return   Order::select('orders.*', 'requests.processUrl As processUrl')
        ->join('requests', 'requests.order_id', '=', 'orders.id')   
        ->where('orders.id',$id)
        ->first();
    }

}