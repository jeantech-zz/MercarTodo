<?php

namespace App\ViewModels\OrderProducts;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class OrderIndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('orders.titles.index'),
                'route' => route('orders.index'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('orderProducts.titles.index');
    }

    protected function filters(): array
    {
        return [
            'order_id' => old('filters.order_id') ?? request()->input('filters.order_id'),
        ];
    }

    protected function headers(): array
    {
       return array_merge(trans('orderProducts.fields'), parent::headers());
    }

    protected function data(): array
    {
        return [
            'orderProducts'  => $this->collection,
        ];
    }
}
