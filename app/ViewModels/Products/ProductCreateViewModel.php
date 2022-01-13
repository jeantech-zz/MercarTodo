<?php

namespace App\ViewModels\Products;

use App\Inputs\Input;
use App\Inputs\NumberInput;
use App\Inputs\TextInput;
use App\Inputs\FileInput;
use App\Inputs\DateInput;
use App\Models\Product;
use App\ViewModels\ViewModel;

class ProductCreateViewModel extends ViewModel
{
    protected function buttons(): array
    {
        return [
            'back' => [
                'text' => trans('common.back'),
                'route' => route('products.index'),
            ],
            'save' => [
                'text' => trans('common.save'),
                'route' => route('products.index'),
            ],
        ];
    }

    protected function title(): string
    {
        return trans('products.titles.create');
    }

    /**
     * @return Input[]
     */
    protected function inputs(): array
    {
        return [
            new TextInput(
                trans('products.labels.code'),
                trans('products.inputs.code'),
                trans('products.placeholders.code'),  
                trans('products.message_error.code'),          
                true               
            ),
            new TextInput(
                trans('products.labels.name'),
                trans('products.inputs.name'),
                trans('products.placeholders.name'),  
                trans('products.message_error.name'),          
                true               
            ),
            new TextInput(
                trans('products.labels.description'),
                trans('products.inputs.description'),
                trans('products.placeholders.description'),
                trans('products.message_error.description'),
                true
            ),
            new NumberInput(
                trans('products.labels.price'),
                trans('products.inputs.price'),
                trans('products.placeholders.price'),
                trans('products.message_error.price'),
                true
            ),
            new NumberInput(
                trans('products.labels.quantity'),
                trans('products.inputs.quantity'),
                trans('products.placeholders.quantity'),
                trans('products.message_error.quantity'),
                true
            ),
            new DateInput(
                trans('products.labels.disable_at'),
                trans('products.inputs.disable_at'),
                trans('products.placeholders.disable_at'),
                trans('products.message_error.disable_at'),
                true
            ),
            new FileInput(
                trans('products.labels.image'),
                trans('products.inputs.image'),
                trans('products.placeholders.image'),
                trans('products.message_error.image'),
                false
            ),           
        ];
    }

    protected function data(): array
    {
        return [
            'model' => new Product(),
            'action' => route('products.store'),
        ];
    }
}
