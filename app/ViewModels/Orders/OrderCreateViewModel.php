<?php

namespace App\ViewModels\Orders;

use App\Inputs\Input;
use App\Inputs\NumberInput;
use App\Inputs\TextInput;
use App\Models\Order;
use App\ViewModels\ViewModel;

class OrderCreateViewModel extends ViewModel
{
    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => route('orders.index'),
            ],
            'save' => [
                'text' => trans('common.save'),
                'route' => route('orders.index'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('orders.titles.create');
    }

    /**
     * @return Input[]
     */
    protected function inputs(): array
    {
        return [
            new HiddenInput(
                trans('orders.labels.user_id'),
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
            new TextInput(
                trans('orders.labels.customer_name'),
                trans('orders.inputs.customer_name'),
                trans('orders.placeholders.customer_name'),  
                trans('orders.message_error.customer_name'),          
                true               
            ),      
            new NumberInput(
                trans('orders.labels.total'),
                trans('orders.inputs.total'),
                trans('orders.placeholders.total'),
                trans('orders.message_error.total'),
                true
            ), 
            new NumberInput(
                trans('orders.labels.currency'),
                trans('orders.inputs.currency'),
                trans('orders.placeholders.currency'),
                trans('orders.message_error.currency'),
                true
            ), 
            new TextInput(
                trans('orders.labels.status'),
                trans('orders.inputs.status'),
                trans('orders.placeholders.status'),  
                trans('orders.message_error.status'),          
                true               
            ),  
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new Order(),
            'action' => '',
        ];
    }
}
