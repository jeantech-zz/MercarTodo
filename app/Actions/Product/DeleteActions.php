<?php

namespace App\Actions\Product;

use App\Models\Product;

class DeleteActions
{
    public static function execute(int $id): Product
    {
        return Product::find($id)->delete();
    }
}
