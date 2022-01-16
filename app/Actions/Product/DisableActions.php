<?php

namespace App\Actions\Product;

use App\Models\Product;

class DisableActions
{
    public static function execute(Product $product)
    {        
        $record= $product->update([ 
            'disable_at' =>  now()
        ]);

        return $record;
    }
}