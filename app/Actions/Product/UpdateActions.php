<?php

namespace App\Actions\Product;

use App\Models\Product;

class UpdateActions
{
    public static function execute(array $data, string $url): Product
    {
      
        $record = Product::find($data['id']);
        
        $record->update([ 
            'name' =>  $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' =>  $url,
            'quantity' => $data['quantity'],
            'code' => $data['code'],
        ]);

        return $record;
    }
}