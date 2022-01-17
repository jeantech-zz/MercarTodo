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
            
        ];
    }

    protected function title(): string
    {
        return trans('orderProducts.titles.index');
    }

    protected function filters(): array
    {
        return [
            'customer_name' => old('filters.customer_name') ?? request()->input('filters.customer_name'),
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
