<?php

namespace App\ViewModels\Orders;

use App\Inputs\Input;
use App\Inputs\TextInput;
use App\Inputs\NumberInput;
use App\Inputs\HiddenInput;
use App\Models\Order;
use App\ViewModels\Concerns\HasModel;


class OrderShowPayViewModel extends OrderCreateViewModel
{
    use HasModel;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => route('orders.index'),
            ],
            'save' => [
                'text' => trans('common.pay'),
                'route' => route('orders.index'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('orders.titles.pay');
    }

    protected function message(): string
    {
        return trans('orders.titles.pay');
    }
    /**
     * @return Input[]
     */
    protected function inputs(): array
    {
        return [
            new HiddenInput(
                trans('orders.labels.id'),
                trans('orders.inputs.id'), 
                trans('orders.message_error.id'),          
                true               
            ),
            new HiddenInput(
                trans('orders.labels.user_idid'),
                trans('orders.inputs.user_id'), 
                trans('orders.message_error.user_id'),          
                true               
            ),
            new TextInput(
                trans('orders.labels.customer_name'),
                trans('orders.inputs.customer_name'),
                trans('orders.placeholders.customer_name'),  
                trans('orders.message_error.customer_name'),          
                false          
            ), 
            new TextInput(
                trans('orders.labels.customer_email'),
                trans('orders.inputs.customer_email'),
                trans('orders.placeholders.customer_email'),  
                trans('orders.message_error.customer_email'),          
                false                              
            ),  
            new TextInput(
                trans('orders.labels.customer_mobile'),
                trans('orders.inputs.customer_mobile'),
                trans('orders.placeholders.customer_mobile'),  
                trans('orders.message_error.customer_mobile'),          
                false               
            ),      
            new NumberInput(
                trans('orders.labels.total'),
                trans('orders.inputs.total'),
                trans('orders.placeholders.total'),
                trans('orders.message_error.total'),
                true,
                'disabled'    
            ), 
            new TextInput(
                trans('orders.labels.currency'),
                trans('orders.inputs.currency'),
                trans('orders.placeholders.currency'),
                trans('orders.message_error.currency'),
                true,
                'disabled'    
            ), 
            new TextInput(
                trans('orders.labels.status'),
                trans('orders.inputs.status'),
                trans('orders.placeholders.status'),  
                trans('orders.message_error.status'),          
                true,
                'disabled'                   
            ),                                   
        ];
    }

    protected function data(): array
    {
        return [
            'model' => $this->model,
            'action' => route('orders.orderPay', $this->model->id),
        ];
    }
}