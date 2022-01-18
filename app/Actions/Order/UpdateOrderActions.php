<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderProduct;

class UpdateOrderActions
{
    public static function execute(Order $order, array $data = [] ): bool
    {
      
        $orderRecord = Order::find($order->id);

        $orderProduct = OrderProduct::Where('order_id', $order->id )->get();
        $totalOrderProduct = $orderProduct->sum('amount');
        

        $dataRecor = [];

        if ($data <> null ){
            if ($data['customer_name'] <>   $orderRecord->customer_name ){
                $dataRecor['customer_name']  = $data['customer_name'];
            }else{
                $dataRecor['customer_name']  = $orderRecord->customer_name;
            }

            if ($data['customer_email'] <>   $orderRecord->customer_email){
                $dataRecor['customer_email']  = $data['customer_email'];
            }else{
                $dataRecor['customer_email']  = $orderRecord->customer_email;
            }

            if ($data['customer_mobile'] <>   $orderRecord->customer_mobile){
                $dataRecor['customer_mobile']  = $data['customer_mobile'];
            }else{
                $dataRecor['customer_mobile']  = $orderRecord->customer_mobile;
            }

            if ($data['currency'] <>   $orderRecord->customcurrencyer_name){
                $dataRecor['currency']  = $data['currency'];
            }else{
                $dataRecor['currency']  = $orderRecord->currency;
            }

            $dataRecor['total']  = $totalOrderProduct;

        }else{
            $dataRecord = [ 
                'customer_name' =>  $orderRecord->customer_name,
                'customer_email' => $orderRecord->customer_email,
                'customer_mobile' => $orderRecord->customer_mobile,
                'total' =>  $totalOrderProduct,
                'currency' => $orderRecord->currency,
                'status' => $orderRecord->status,
            ];
        }
     
        $record = $orderRecord->update([ 
            'customer_name' =>  $dataRecor['customer_name'],
            'customer_email' => $dataRecor['customer_email'],
            'customer_mobile' => $dataRecor['customer_mobile'],
            'total' =>  $dataRecor['total'],
            'currency' => $dataRecor['currency'],
            'status' => $dataRecor['status'],
        ]);

        return $record;
    }
}