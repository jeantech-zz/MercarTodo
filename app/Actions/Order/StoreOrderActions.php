<?php

namespace App\Actions\Order;

use App\Models\Order;

class StoreOrderActions
{
    public static function execute(): Order
    {
        $statusInprocess = config('app.statusOrderInprocess');
        $currency = config('app.currency');

        $order = Order::Where('user_id',auth()->id())
        ->Where('status', $statusInprocess )->first();
        
        if(!$order ){
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => 1,
                'status' => $statusInprocess,
                'currency' => $currency,
            ]);
        }
        return  $order;
       
    }
}

