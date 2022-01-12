<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DisableActions
{
    public static function execute(int $id): User
    {
       
        $record = User::find($id);

            $record->update([ 
                'disable_at' => date("Y-m-d H:i:s")  
            ]);

        return $record;
    }
}