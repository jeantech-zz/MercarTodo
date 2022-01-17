<?php

namespace App\ViewModels\Orders;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class OrderIndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            
        ];
    }

    protected function title(): string
    {
        return trans('orders.titles.index');
    }

    protected function filters(): array
    {
        return [
            'customer_name' => old('filters.customer_name') ?? request()->input('filters.customer_name'),
        ];
    }

    protected function headers(): array
    {
       return array_merge(trans('orders.fields'), parent::headers());
    }

    protected function data(): array
    {
        return [
            'orders'  => $this->collection,
        ];
    }
}
