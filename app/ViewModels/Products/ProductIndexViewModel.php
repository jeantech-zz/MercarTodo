<?php

namespace App\ViewModels\Products;

use App\ViewModels\Concerns\HasPaginator;
use App\ViewModels\ViewModel;

class ProductIndexViewModel extends ViewModel
{
    use HasPaginator;

    protected function buttons(): array
    {
        return [
            'create' => [
                'text' => trans('products.titles.create'),
                'route' => route('products.create'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('products.titles.index');
    }

    protected function filters(): array
    {
        return [
            'name' => old('filters.name') ?? request()->input('filters.name'),
            'description' => old('filters.description') ?? request()->input('filters.description'),
        ];
    }

    protected function headers(): array
    {
       return array_merge(trans('products.fields'), parent::headers());
    }

    protected function data(): array
    {
        return [
            'products'  => $this->collection,
        ];
    }
}
